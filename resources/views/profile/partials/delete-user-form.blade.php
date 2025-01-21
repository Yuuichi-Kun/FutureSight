<section class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden">
    <header class="p-6 bg-gray-50 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div class="p-6">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="btn-danger">
            {{ __('Delete Account') }}
        </button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                        placeholder="{{ __('Password') }}" />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <br>

                <div class="mt-6 flex justify-end gap-4">
                    <button x-on:click="$dispatch('close')" class="px-4 py-2 btn-secondary">
                        {{ __('Cancel') }}
                    </button>

                    <button class="px-4 py-2 btn-danger">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </x-modal>
    </div>
</section>