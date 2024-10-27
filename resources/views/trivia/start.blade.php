@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-6 px-5 sm:px-5 lg:px-8">
        <h1 class="text-xl font-bold mb-1">Trivia Questions</h1>
    </div>
    <div class="py-12" style="background-color: #6A9C89; height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('trivia.index') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <p class="mb-4">Test your knowledge with trivia questions across various categories. Choose a category and number of questions to get started.</p>

                        <!-- Category Selection -->
                        <label class="block mb-2 text-lg font-semibold" for="category">Select Category:</label>
                        <select name="category" id="category" class="block w-full p-2 border border-gray-300 rounded">
                            <option value="0">Any Category</option>
                            <option value="9">General Knowledge</option>
                            <option value="22">Geography</option>
                            <option value="23">History</option>
                            <option value="10">Books</option>
                            <option value="21">Sports</option>
                            <option value="20">Mythology</option>
                            <option value="17">Science and Nature</option>
                            <option value="25">Art</option>
                            <option value="12">Music</option>
                        </select>

                        <!-- Question Amount Selection -->
                        <label class="block mt-4 mb-2 text-lg font-semibold" for="amount">Select Number of Questions:</label>
                        <select name="amount" id="amount" class="block w-full p-2 border border-gray-300 rounded">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition ease-in-out duration-150">
                    Start Trivia
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
