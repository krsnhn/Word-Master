<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DictionaryController extends Controller
{
    public function index()
    {
        // Fetch search history for the logged-in user, with pagination
        $searchHistories = SearchHistory::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->distinct('word')
            ->paginate(10);

        return view('dictionary.index', ['searchHistories' => $searchHistories]);
    }

    public function findWord(Request $request)
{
    // Validate the form inputs
    $request->validate([
        'word' => 'required|string',
    ]);

    $word = $request->input('word');

    // Create a Guzzle client with SSL verification disabled
    $client = new Client(['verify' => false]);

    try {
        $response = $client->get("https://api.dictionaryapi.dev/api/v2/entries/en/{$word}");

        // Parse the response
        $body = json_decode($response->getBody(), true);

        // Extract details from the response
        $details = $this->extractWordDetails($body);

        // Log that the word was successfully found
        Log::info("Successfully found word: '{$word}'");

        // Save word to search history only if it doesn't already exist for this user
        SearchHistory::firstOrCreate([
            'word' => $word,
            'user_id' => Auth::id(), // Link to the logged-in user
        ]);

        // Pass the word to the view along with the details
        return view('dictionary.index', array_merge($details, ['word' => $word]));
    } catch (\Exception $e) {
        // Log the error for further debugging
        Log::error('Error retrieving word: ' . $e->getMessage());

        // Handle exception if something goes wrong
        $error =  "Word '{$word}' not found.";
        return view('dictionary.index')->with('error', $error);
    }
}


    public function showHistory()
    {
        // Fetch only the search history for the logged-in user, with pagination
        $searchHistories = SearchHistory::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->distinct('word')
            ->paginate(10);

        return view('dictionary.history', ['searchHistories' => $searchHistories]);
    }

    public function showWordDetails($word)
    {
        // Define a cache key using the word
        $cacheKey = "word_details_{$word}";
    
        // Check if the word details are already cached
        if (Cache::has($cacheKey)) {
            // Retrieve the cached word details
            $details = Cache::get($cacheKey);
    
            // Log that the details were retrieved from the cache
            Log::info("Retrieved word details for '{$word}' from cache.");
        } else {
            $client = new Client(['verify' => false]);
    
            try {
                // Make the API call to fetch word details if not cached
                $response = $client->get("https://api.dictionaryapi.dev/api/v2/entries/en/{$word}");
    
                // Decode the response body
                $body = json_decode($response->getBody(), true);
    
                // Extract word details using the helper function
                $details = $this->extractWordDetails($body);
    
                // Cache the word details for 60 minutes
                Cache::put($cacheKey, $details, now()->addMinutes(60));
            } catch (\Exception $e) {
                // Log any errors during the API call
                Log::error('Error retrieving word details: ' . $e->getMessage());
    
                // Return an error message to the view
                $error = 'Error retrieving word details. Please try again later.';
                return view('dictionary.index')->with('error', $error);
            }
        }
    
        // Return the view with the word details
        return view('dictionary.index', array_merge($details, ['word' => $word]));
    }
    

    private function extractWordDetails($body)
    {
        $phonetics = [];
        $meanings = [];
        $examples = [];
        $synonyms = [];
        $antonyms = [];
        $origin = 'No origin information available';

        // Extract phonetics
        if (isset($body[0]['phonetics'])) {
            foreach ($body[0]['phonetics'] as $phonetic) {
                if (isset($phonetic['text'])) {
                    $phonetics[] = $phonetic['text'];
                }
            }
        }

        // Extract meanings, synonyms, antonyms, and examples
        if (isset($body[0]['meanings'])) {
            foreach ($body[0]['meanings'] as $meaning) {
                $partOfSpeech = $meaning['partOfSpeech'] ?? 'unknown';

                foreach ($meaning['definitions'] as $definition) {
                    $meanings[$partOfSpeech][] = [
                        'definition' => $definition['definition'],
                        'example' => $definition['example'] ?? null,
                        'synonyms' => $definition['synonyms'] ?? [],
                        'antonyms' => $definition['antonyms'] ?? [],
                    ];

                    if (isset($definition['example'])) {
                        $examples[] = $definition['example'];
                    }
                }

                // Extract synonyms and antonyms
                if (isset($meaning['synonyms'])) {
                    foreach ($meaning['synonyms'] as $synonym) {
                        $synonyms[] = $synonym;
                    }
                }
                if (isset($meaning['antonyms'])) {
                    foreach ($meaning['antonyms'] as $antonym) {
                        $antonyms[] = $antonym;
                    }
                }
            }
        }

        // Extract origin if available
        if (isset($body[0]['origin'])) {
            $origin = $body[0]['origin'];
        }

        return [
            'phonetics' => implode(', ', $phonetics),
            'origin' => $origin,
            'meanings' => $meanings,
            'examples' => $examples,
            'synonyms' => $synonyms,
            'antonyms' => $antonyms,
        ];
    }

    public function delete($word)
    {
        // Find and delete the specific search history entry for the logged-in user
        $searchHistory = SearchHistory::where('word', $word)
            ->where('user_id', Auth::id())
            ->first();

        if ($searchHistory) {
            $searchHistory->delete();
            return redirect()->route('dictionary.history')->with('success', 'Search history item deleted.');
        }

        return redirect()->route('dictionary.history')->with('error', 'Word not found in your search history.');
    }
}
