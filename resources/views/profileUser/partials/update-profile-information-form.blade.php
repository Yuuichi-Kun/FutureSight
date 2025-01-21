<section class="bg-white rounded-lg shadow-sm overflow-hidden">
    <header class="p-6 bg-gray-50 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <div class="p-6">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            <div class="space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="name" name="name" type="text" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="email" name="email" type="email" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-3 p-4 bg-yellow-50 rounded-md">
                            <p class="text-sm text-yellow-700">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" 
                                    class="ml-2 underline text-sm text-yellow-600 hover:text-yellow-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm font-medium text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                {{ __('Save Changes') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }"
                       x-show="show"
                       x-transition
                       x-init="setTimeout(() => show = false, 2000)"
                       class="text-sm text-green-600">
                        {{ __('Saved successfully.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>