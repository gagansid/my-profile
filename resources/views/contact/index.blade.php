@extends('layouts.public')

@section('seo')
    <x-seo :title="__('contact.title')" />
@endsection

@section('content')
    <div class="text-center mb-2">
        <h2>{{ __('contact.title') }}</h2>
    </div>

    <div class="contact-form-wrapper">
        <div id="contact-status" class="admin-alert admin-alert--success mb-2 text-center" @if (session('status') !== 'contact-sent') hidden @endif>
            {{ __('contact.success') }}
        </div>

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
                    class="form-input" autocomplete="off" value="{{ old('fullname') }}" required />
                <small id="error-fullname" style="color: crimson;">@error('fullname'){{ $message }}@enderror</small>
            </div>

            <div class="mb-1">
                <label for="email" class="form-label">{{ __('contact.email') }}</label>
                <input type="email" name="email" id="email" placeholder="{{ __('contact.email_placeholder') }}"
                    class="form-input" autocomplete="off" value="{{ old('email') }}" required />
                <small id="error-email" style="color: crimson;">@error('email'){{ $message }}@enderror</small>
            </div>

            <div>
                <label for="message" class="form-label">{{ __('contact.message') }}</label>
                <textarea rows="5" name="message" id="message" class="form-input" required>{{ old('message') }}</textarea>
                <small id="error-message" style="color: crimson;">@error('message'){{ $message }}@enderror</small>
            </div>

            <button class="contact-btn" id="contact-submit">
                {{ __('contact.send') }}
            </button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const contactForm = document.getElementById('contact-form');

        contactForm?.addEventListener('submit', async function (event) {
            event.preventDefault();

            const submitBtn = document.getElementById('contact-submit');
            const statusBox = document.getElementById('contact-status');
            const fields = ['fullname', 'email', 'message'];

            fields.forEach((field) => {
                const errorEl = document.getElementById(`error-${field}`);
                if (errorEl) errorEl.textContent = '';
            });
            if (statusBox) statusBox.hidden = true;

            const submitBtnDefaultText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = '...';

            try {
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: new FormData(contactForm),
                    headers: { 'Accept': 'application/json' },
                });

                if (response.status === 422) {
                    const data = await response.json();
                    Object.entries(data.errors || {}).forEach(([field, messages]) => {
                        const errorEl = document.getElementById(`error-${field}`);
                        if (errorEl) errorEl.textContent = messages[0];
                    });
                    return;
                }

                if (!response.ok) throw new Error('Request failed');

                contactForm.reset();
                if (statusBox) statusBox.hidden = false;
            } catch (error) {
                contactForm.submit();
                return;
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = submitBtnDefaultText;
            }
        });
    </script>
@endpush
