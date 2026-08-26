<section>
    <header class="admin-card__header">
        <h2 class="admin-card__title">
            Update Password
        </h2>

        <p class="admin-card__description">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="admin-form">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Current Password" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="New Password" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Confirm Password" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="admin-form__actions">
            <x-primary-button>Save</x-primary-button>

            @if (session('status') === 'password-updated')
                <p class="admin-hint">Saved.</p>
            @endif
        </div>
    </form>
</section>
