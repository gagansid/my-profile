<x-guest-layout>
    <div class="admin-hint mb-4">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="admin-alert admin-alert--success mb-4">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="admin-form__actions">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>
                Resend Verification Email
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="admin-hint" style="background: none; border: none; cursor: pointer;">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
