<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 p-6">
        <!-- Responsive Container -->
        <div class="w-full sm:max-w-3xl bg-white shadow-lg rounded-lg p-8">
            <!-- Application Title -->
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Welcome Back!</h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-blue-500 focus:ring-blue-500 rounded-lg" 
                                  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-6">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full border-pink-500 focus:ring-pink-500 rounded-lg"
                                  type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex flex-col justify-between mt-8 space-y-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                        href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-between mt-8 space-y-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                        href="{{ route('register') }}">
                            {{ __('Create an account') }}
                        </a>

                    <x-primary-button class="mt-4 bg-gradient-to-r from-blue-600 to-pink-500 text-white px-6 py-3 rounded-lg hover:opacity-90 transform transition duration-500 hover:scale-105">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <style>
        body {
            background-image: url('https://www.enago.com/academy/wp-content/uploads/2017/09/Background.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        .bg-gradient-to-r {
            background: linear-gradient(to right, #3b82f6, #9333ea, #f43f5e);
        }
    </style>
</x-guest-layout>
