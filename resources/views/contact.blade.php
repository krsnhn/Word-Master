@extends('layouts.app')

@section('content')
<!-- Contact Page Heading -->
<div class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-5 sm:px-5 lg:px-8">
        <h1 class="text-xl font-bold mb-1">Contact</h1>
    </div>
</div>

<!-- Contact Form Section -->
<div class="py-12" style="background-color: #6A9C89; height: 100%;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-8 sm:p-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">We'd Love to Hear From You!</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Please fill out the form below to send us a message, and we will get back to you as soon as possible.</p>

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">Name:</label>
                    <input type="text" id="name" name="name" required
                           class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 placeholder-gray-400"
                           placeholder="Your Name">
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">Email:</label>
                    <input type="email" id="email" name="email" required
                           class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 placeholder-gray-400"
                           placeholder="Your Email">
                </div>

                <!-- Message Field -->
                <div>
                    <label for="message" class="block text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">Message:</label>
                    <textarea id="message" name="message" required
                              class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 placeholder-gray-400"
                              placeholder="Your Message" rows="6"></textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition ease-in-out duration-150">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
