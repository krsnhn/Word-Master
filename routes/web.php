<?php

// web.php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TriviaController;

use App\Http\Controllers\Auth\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/callback/google', [GoogleController::class, 'handleGoogleCallback']);


// Route to display the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Update the dashboard route to use DictionaryController@index
Route::get('/dashboard', [DictionaryController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dictionary', [DictionaryController::class, 'index'])->name('dictionary.index');
    Route::post('/dictionary/search', [DictionaryController::class, 'findWord'])->name('dictionary.find');
    Route::get('/dictionary/history', [DictionaryController::class, 'showHistory'])->name('dictionary.history');
    Route::get('/dictionary/{word}', [DictionaryController::class, 'showWordDetails'])->name('dictionary.showWordDetails');
    Route::delete('/dictionary/delete/{word}', [DictionaryController::class, 'delete'])->name('dictionary.delete');
});

// Other routes...
Route::get('/trivia/start', [TriviaController::class, 'start'])->name('trivia.start'); // Show start page
Route::post('/trivia', [TriviaController::class, 'index'])->name('trivia.index'); // Submit category selection
Route::post('/trivia/submit', [TriviaController::class, 'submit'])->name('trivia.submit'); // Submit answers

// Auth routes
require __DIR__.'/auth.php';

