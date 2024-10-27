@extends('layouts.app')

@section('content')
<!-- About Page Heading -->
<div class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-5 sm:px-5 lg:px-8">
        <h1 class="text-xl font-bold mb-1">About</h1>
    </div>
</div>

<!-- About Page Content -->
<div class="py-12" style="background-color: #6A9C89; height: 100%;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Introduction Section -->
        <div class="p-8 sm:p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Introduction</h2>
            <p class="text-gray-700 dark:text-gray-300 text-lg">
                Welcome to the Dictionary Lookup app! Our app provides detailed information about any word you enter, including its phonetics, meanings, origins, synonyms, and antonyms.
            </p>
        </div>

        <!-- Features Section -->
        <div class="p-8 sm:p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Features</h2>
            <ul class="list-disc pl-5 text-gray-700 dark:text-gray-300 text-lg">
                <li><strong>Phonetics:</strong> Get the correct pronunciation of any word.</li>
                <li><strong>Meanings:</strong> Discover multiple meanings and usage contexts.</li>
                <li><strong>Origins:</strong> Learn about the history and etymology of the word.</li>
                <li><strong>Examples:</strong> See example sentences to understand word usage.</li>
                <li><strong>Synonyms and Antonyms:</strong> Find similar and opposite words to expand your vocabulary.</li>
            </ul>
        </div>

        <!-- How It Works Section -->
        <div class="p-8 sm:p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">How It Works</h2>
            <p class="text-gray-700 dark:text-gray-300 text-lg">
                Simply enter a word into the search box, and our app will provide you with comprehensive information about that word. Whether you’re a student, a writer, or just curious about words, our app is designed to help you enhance your understanding and use of language.
            </p>
        </div>

        <!-- Contact Section -->
        <div class="p-8 sm:p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Contact Us</h2>
            <p class="text-gray-700 dark:text-gray-300 text-lg">
                If you have any questions, feedback, or suggestions, feel free to reach out to us at <a href="mailto:info@dictionarylookup.com" class="text-indigo-600 dark:text-indigo-400 hover:underline">info@dictionarylookup.com</a>.
            </p>
        </div>

    </div>
</div>
@endsection
