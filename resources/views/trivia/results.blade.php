@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-6 px-5 sm:px-5 lg:px-8">
        <h1 class="text-xl font-bold mb-1">Trivia Results</h1>
    </div>
    <!-- Main Content -->
    <div class="py-12" style="background-color: #6A9C89; height: 100%;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-center mb-4">Your Score</h2>
                <p class="text-2xl font-semibold text-center mb-6">{{ $score }} / {{ $total }}</p>

                <!-- Detailed Results -->
                @foreach ($results as $index => $result)
                    <div class="mb-6 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <h3 class="text-lg font-bold mb-2">{{ $loop->iteration }}. {{ $result['question'] }}</h3>
                        <p class="mb-2"><strong>Your Answer:</strong> {{ $result['user_answer'] ?? 'Not Answered' }}</p>
                        <p><strong>Correct Answer:</strong> {{ $result['correct_answer'] }}</p>
                    </div>
                @endforeach

                <!-- Buttons -->
                <div class="mt-8 flex gap-x-4 justify-center">
                    <a href="{{ route('trivia.start') }}" class="bg-indigo-600 text-white text-center font-semibold py-2 px-4 rounded-lg shadow-lg border-4 border-indigo-700 hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition ease-in-out duration-150 flex-1">
                        Try Again
                    </a>
                </div>

                <br>
               <div class="mt-8 flex gap-x-4 justify-center">
                    <a href="{{ route('dashboard') }}" class="bg-gray-600 text-black text-center font-semibold py-2 px-4 rounded-lg shadow-lg border-2 border-black-300 hover:bg-gray-500 focus:ring-2 focus:ring-gray-400 focus:outline-none transition ease-in-out duration-150 flex-1">
                        Back to Home
                    </a>
                </div>
                







            </div>
        </div>
    </div>
@endsection
