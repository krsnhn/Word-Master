@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4 text-center">Profile</h1>

        @include('profile.partials.forms') <!-- Ensure this path is correct -->
    </div>
@endsection
