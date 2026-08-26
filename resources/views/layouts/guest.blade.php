<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

        <!-- Scripts -->
        @vite(['resources/scss/styles.scss', 'resources/js/main.js'])
    </head>
    <body>
        <div class="admin" style="display: grid; place-items: center;">
            <div class="admin-card" style="width: 100%; max-width: 24rem; margin: 2rem 1.5rem;">
                <div class="admin-card__header" style="text-align: center;">
                    <a href="{{ url('/') }}" class="admin-topbar__brand">{{ config('app.name') }}</a>
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
