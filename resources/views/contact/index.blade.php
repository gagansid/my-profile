@extends('layouts.public')

@section('seo')
    <x-seo :title="__('contact.title')" />
@endsection

@section('content')
    <div class="text-center mb-2">
        <h2>{{ __('contact.title') }}</h2>
    </div>

    @if (session('status') === 'contact-sent')
        <div class="mb-2 text-center" style="color: var(--first-color);">
            {{ __('contact.success') }}
        </div>
    @endif

    <div class="contact-form-wrapper">
        <form action="{{ route('contact.store') }}" method="POST" id="contact-form">
            @csrf

            {{-- Honeypot: hidden from real visitors via CSS, bots often fill every field --}}
            <div style="position:absolute; left:-9999px;" aria-hidden="true">
                <label for="website">Website</label>
                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="mb-1">
                <label for="fullname" class="form-label">{{ __('contact.fullname') }}</label>
                <input type="text" name="fullname" id="fullname" placeholder="{{ __('contact.fullname_placeholder') }}"
                    class="contact-form-input" autocomplete="off" value="{{ old('fullname') }}" required />
                @error('fullname')
                    <small style="color: crimson;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-1">
                <label for="email" class="form-label">{{ __('contact.email') }}</label>
                <input type="email" name="email" id="email" placeholder="{{ __('contact.email_placeholder') }}"
                    class="contact-form-input" autocomplete="off" value="{{ old('email') }}" required />
                @error('email')
                    <small style="color: crimson;">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="message" class="form-label">{{ __('contact.message') }}</label>
                <textarea rows="5" name="message" id="message" class="contact-form-input" required>{{ old('message') }}</textarea>
                @error('message')
                    <small style="color: crimson;">{{ $message }}</small>
                @enderror
            </div>

            <button class="contact-btn" id="contact-submit">
                {{ __('contact.send') }}
            </button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('contact-form')?.addEventListener('submit', function () {
            const btn = document.getElementById('contact-submit');
            btn.disabled = true;
            btn.textContent = '...';
        });
    </script>
@endpush
