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
        @vite(['resources/scss/styles.scss', 'resources/js/main.js', 'resources/js/admin.js'])
    </head>
    <body>
        <div class="admin">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <div class="admin-main" style="padding-bottom: 0;">
                    {{ $header }}
                </div>
            @endisset

            <!-- Page Content -->
            <main class="admin-main">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
