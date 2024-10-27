@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-6 px-5 sm:px-5 lg:px-8">
        <h1 class="text-xl font-bold mb-1" style="color: #16423C;">Word Dictionary</h1>
    </div>
    <!-- Main Content -->
    <div class="py-12" style="background-color: #6A9C89; height: 100%;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Form Section -->
            <div class="p-8 sm:p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                <div class="max-w-xl mx-auto">
                <form method="POST" action="{{ route('dictionary.find') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="word" class="block text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">Enter a word:</label>
                            <input type="text" id="word" name="word" required
                                   class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 placeholder-gray-400"
                                   placeholder="Type a word">
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition ease-in-out duration-150">
                                Get Definition
                            </button>
                        </div>
                    </form>
                </div>
            <br>
            <br>
            <!-- Word Details Section -->
            @if (isset($phonetics) || isset($error))
                <div class="p-6 sm:p-8 bg-white dark:bg-gray-800">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 text-center">Word Details</h2>

                    @if (isset($error))
                        <p class="text-red-500 text-center">{{ $error }}</p>
                    @endif

                    @if (isset($phonetics))
                        <div class="space-y-6 text-center">
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                <strong>Word:</strong> <strong>{{ $word }}</strong>
                            </p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                <strong>Phonetics:</strong> {{ $phonetics }}
                            </p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                <strong>Origin:</strong> {{ $origin ?? 'No origin information available' }}
                            </p>

                            <!-- Meanings Section -->
                            @if (!empty($meanings))
                                <div class="text-left mx-auto max-w-xl">
                                    @foreach ($meanings as $partOfSpeech => $definitions)
                                        <div class="mb-6">
                                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">{{ ucfirst($partOfSpeech) }}:</h3>
                                            @foreach ($definitions as $definition)
                                                <div class="mb-4">
                                                    <p class="text-gray-700 dark:text-gray-300"><strong>Definition:</strong> {{ $definition['definition'] }}</p>
                                                    @if (!empty($definition['example']))
                                                        <p class="text-gray-700 dark:text-gray-300"><strong>Example:</strong> {{ $definition['example'] }}</p>
                                                    @endif
                                                    @if (!empty($definition['synonyms']))
                                                        <p class="text-gray-700 dark:text-gray-300"><strong>Synonyms:</strong> {{ implode(', ', $definition['synonyms']) }}</p>
                                                    @endif
                                                    @if (!empty($definition['antonyms']))
                                                        <p class="text-gray-700 dark:text-gray-300"><strong>Antonyms:</strong> {{ implode(', ', $definition['antonyms']) }}</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Synonyms Section -->
                            @if (!empty($synonyms))
                                <div class="text-left mx-auto max-w-xl">
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">Global Synonyms:</h3>
                                    <p class="text-gray-700 dark:text-gray-300">{{ implode(', ', $synonyms) }}</p>
                                </div>
                            @endif

                            <!-- Antonyms Section -->
                            @if (!empty($antonyms))
                                <div class="text-left mx-auto max-w-xl">
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">Global Antonyms:</h3>
                                    <p class="text-gray-700 dark:text-gray-300">{{ implode(', ', $antonyms) }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
