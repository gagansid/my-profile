<section>
    <header class="admin-card__header">
        <h2 class="admin-card__title">
            Profile Information
        </h2>

        <p class="admin-card__description">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="admin-form">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="admin-hint mt-2">
                        Your email address is unverified.

                        <button form="send-verification" class="admin-hint" style="background: none; border: none; cursor: pointer; text-decoration: underline;">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="admin-alert admin-alert--success mt-2">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="admin-form__actions">
            <x-primary-button>Save</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="admin-hint">Saved.</p>
            @endif
        </div>
    </form>
</section>
