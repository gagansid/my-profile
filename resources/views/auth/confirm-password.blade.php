<x-guest-layout>
    <div class="admin-hint mb-4">
        This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="admin-form">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="admin-form__actions">
            <x-primary-button>
                Confirm
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
