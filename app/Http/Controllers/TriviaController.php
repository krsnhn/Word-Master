<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TriviaController extends Controller
{
    public function start()
    {
        return view('trivia.start');
    }

    public function index(Request $request)
{
    $category = $request->input('category');
    $amount = $request->input('amount', 5); // Default to 20 if no amount is selected

    // Update API URL with category and amount
    $apiUrl = "https://opentdb.com/api.php?amount={$amount}&category={$category}";

    $client = new Client(['verify' => false]);

    try {
        $response = $client->get($apiUrl);
        $data = json_decode($response->getBody(), true);
        $triviaQuestions = $data['results'] ?? [];

        // Decode HTML entities in questions and answers
        foreach ($triviaQuestions as &$question) {
            $question['question'] = html_entity_decode($question['question']);
            $question['correct_answer'] = html_entity_decode($question['correct_answer']);
            $question['incorrect_answers'] = array_map('html_entity_decode', $question['incorrect_answers']);
        }

        return view('trivia.index', ['triviaQuestions' => $triviaQuestions]);
    } catch (\Exception $e) {
        Log::error('Error retrieving trivia questions: ' . $e->getMessage());

        $error = 'Error retrieving trivia questions. Please try again later.';
        return view('trivia.index')->with('error', $error);
    }
}

    public function submit(Request $request)
    {
        $questions = $request->input('questions');
        $score = 0;
        $results = [];

        foreach ($questions as $index => $question) {
            $correct = html_entity_decode($question['correct_answer']);
            $userAnswer = html_entity_decode($question['answer'] ?? null);

            if ($userAnswer == $correct) {
                $score++;
            }

            $results[] = [
                'question' => html_entity_decode($question['question']),
                'correct_answer' => $correct,
                'user_answer' => $userAnswer,
            ];
        }

        return view('trivia.results', ['score' => $score, 'total' => count($questions), 'results' => $results]);
    }
}
