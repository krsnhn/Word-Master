<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">   
            <x-primary-button class="w-full flex items-center justify-center bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow-lg hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition ease-in-out duration-150">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        <br>
        <div class="flex items-center justify-center my-4">
            <hr class="flex-grow border-t border-gray-300" />
            <span class="mx-4 text-gray-500">OR</span>
            <hr class="flex-grow border-t border-gray-300" />
        </div>
        <br>
        <div class="flex items-center justify-center"> <!-- Increased margin-top for consistent spacing -->
            <x-primary-button class="w-full flex items-center justify-center bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow-lg hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition ease-in-out duration-150" 
                onclick="window.location='{{ route('google.login') }}'">
                {{ __('Sign in with Google') }}
            </x-primary-button>
        </div>


            
            <div class="flex items-center justify-between mt-4">
                    <p class="text-sm text-gray-600">Already have an account?
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Login') }}
                        </a>
                    @endif
                    </p>
                </div>

        </div>
    </form>
</x-guest-layout>
