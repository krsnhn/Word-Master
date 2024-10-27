
    <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex justify-between items-center mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            
        </div>


        <div class="flex items-center justify-between mt-4">   
            <x-primary-button class="w-full flex items-center justify-center bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow-lg hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition ease-in-out duration-150">
                {{ __('Log in') }}
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
                {{ __(key: 'Log in with Google') }}
            </x-primary-button>
        </div>


            
            <div class="flex items-center justify-between mt-4">
                    <p class="text-sm text-gray-600">Don't have an account?
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Register') }}
                        </a>
                    @endif
                    </p>
                </div>

        </div>
        </div>
    </form>
    </x-guest-layout>
