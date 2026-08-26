<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite(['resources/scss/styles.scss', 'resources/js/main.js'])

    @hasSection('seo')
        @yield('seo')
    @else
        <x-seo />
    @endif
</head>

<body>
    <header class="profile container">
        <i class="ri-moon-line change-theme" id="theme-button"></i>

        <a href="{{ route('locale.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}"
            class="lang-button" id="lang-button" rel="nofollow">
            {{ app()->getLocale() === 'id' ? 'EN' : 'ID' }}
        </a>

        <div class="profile__container grid">
            @php
                $profile = $profile ?? \App\Models\ProfileInfo::query()->first();
                $socialLinks = $socialLinks ?? \App\Models\SocialLink::query()->where('is_active', true)->orderBy('order')->get();
            @endphp
            @include('partials.profile', ['profile' => $profile, 'socialLinks' => $socialLinks])
        </div>
    </header>

    <main class="main">
        <section class="filters container">
            @include('partials.nav')

            <div class="filters__sections">
                @yield('content')
            </div>
        </section>
    </main>

    <footer class="footer container">
        <span class="footer__copy">
            &#169; <strong>{{ config('app.name') }}</strong>. All rights reserved
        </span>
    </footer>

    @stack('scripts')
</body>

</html>
