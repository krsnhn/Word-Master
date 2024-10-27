<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        try {
            // Logic to handle contact form submission
            // Example: Send an email to the admin
            Mail::raw(
                "Name: {$request->name}\nEmail: {$request->email}\nMessage: {$request->message}",
                function ($message) {
                    $message->to('nahinekrisia@gmail.com')->subject('Contact Form Submission');
                }
            );

            return redirect('/contact')->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Contact form submission error: ' . $e->getMessage());

            return redirect('/contact')->with('error', 'Failed to send your message. Please try again later.');
        }
    }
}
