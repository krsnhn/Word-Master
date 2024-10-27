@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-6 px-5 sm:px-5 lg:px-8">
        <h1 class="text-xl font-bold mb-1">Trivia Questions</h1>
    </div>
    <!-- Main Content -->
    <div class="py-12" style="background-color: #6A9C89; height: 100%;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
          

            <!-- Trivia Questions Section -->
            @if (isset($triviaQuestions) && count($triviaQuestions) > 0)
                <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                      <!-- Instructions -->
                <p class="text-gray-700 dark:text-gray-300 mb-4">Please answer the following questions by selecting the correct option. Once you have completed the quiz, click the "Submit" button to see your results.</p>

                    <form action="{{ route('trivia.submit') }}" method="POST">
                        @csrf
                        @foreach ($triviaQuestions as $index => $question)
                            <div class="mb-6 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $loop->iteration }}. {{ $question['question'] }}</h2>
                                <input type="hidden" name="questions[{{ $index }}][question]" value="{{ $question['question'] }}">
                                <input type="hidden" name="questions[{{ $index }}][correct_answer]" value="{{ $question['correct_answer'] }}">

                                <!-- Incorrect Answers -->
                                @foreach ($question['incorrect_answers'] as $answer)
                                    <div class="flex items-center mb-4">
                                        <input type="radio" id="q{{ $index }}_{{ $loop->index }}" name="questions[{{ $index }}][answer]" value="{{ $answer }}" class="mr-3" required>
                                        <label for="q{{ $index }}_{{ $loop->index }}" class="text-gray-700 dark:text-gray-300">{{ $answer }}</label>
                                    </div>
                                @endforeach

                                <!-- Correct Answer -->
                                <div class="flex items-center mb-4">
                                    <input type="radio" id="q{{ $index }}_correct" name="questions[{{ $index }}][answer]" value="{{ $question['correct_answer'] }}" class="mr-3">
                                    <label for="q{{ $index }}_correct" class="text-gray-700 dark:text-gray-300">{{ $question['correct_answer'] }}</label>
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition ease-in-out duration-150">
                            Submit
                        </button>
                    </form>
                </div>
            @elseif (isset($error))
                <p class="text-red-500 text-center">{{ $error }}</p>
            @endif
        </div>
    </div>
@endsection
