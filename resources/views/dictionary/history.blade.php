@extends('layouts.app')

@section('content')
<div class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-5 sm:px-6 lg:px-8">
        <h1 class="text-xl font-bold mb-1">Search History</h1>
    </div>
</div>

<div class="py-12" style="background-color: #6A9C89; height: 100vh;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-8 sm:p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Your Search History</h2>

            @if ($searchHistories->isEmpty())
                <p class="text-gray-700 dark:text-gray-300">No search history found.</p>
            @else
                <ul class="list-disc pl-5 text-gray-700 dark:text-gray-300">
                    @foreach ($searchHistories as $history)
                        <li class="flex items-center justify-between">
                            <a href="{{ route('dictionary.showWordDetails', ['word' => $history->word]) }}"
                               class="text-indigo-600 hover:text-indigo-500 font-semibold">
                                {{ $history->word }}
                            </a>
                            <form action="{{ route('dictionary.delete', ['word' => $history->word]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-500">
                                    Delete
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $searchHistories->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
