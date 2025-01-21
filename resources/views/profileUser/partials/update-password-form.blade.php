<section class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden">
    <header class="p-6 bg-gray-50 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <div class="p-6">
        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <x-input-label for="update_password_password" :value="__('New Password')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="update_password_password" name="password" type="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-success">
                {{ __('Update Password') }}
            </button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }"
                       x-show="show"
                       x-transition
                       x-init="setTimeout(() => show = false, 2000)"
                       class="text-sm text-green-600">
                        {{ __('Password updated successfully.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>
