<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 p-6">
        <!-- Responsive Container -->
        <div class="w-full sm:max-w-3xl bg-white shadow-lg rounded-lg p-8">
            <!-- Application Title -->
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Create Your Account</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full border-blue-500 focus:ring-blue-500 rounded-lg" 
                                  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-purple-500 focus:ring-purple-500 rounded-lg" 
                                  type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-6">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full border-pink-500 focus:ring-pink-500 rounded-lg"
                                  type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-blue-500 focus:ring-blue-500 rounded-lg"
                                  type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                       href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4 bg-gradient-to-r from-blue-600 to-pink-500 text-white px-6 py-3 rounded-lg hover:opacity-90 transform transition duration-500 hover:scale-105">
                        {{ __('Register') }}
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
