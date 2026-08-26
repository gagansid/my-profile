<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="admin-form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="admin-hint">
                <input id="remember_me" type="checkbox" name="remember">
                <span class="ms-2">Remember me</span>
            </label>
        </div>

        <div class="admin-form__actions">
            <x-primary-button>
                Log in
            </x-primary-button>

            @if (Route::has('password.request'))
                <a class="admin-hint" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
