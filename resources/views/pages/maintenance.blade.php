<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite(['resources/scss/styles.scss'])
    <title>{{ config('app.name') }} — Maintenance</title>
    <meta name="robots" content="noindex">
</head>

<body>
    <div class="maintenance container">
        <i class="ri-tools-fill maintenance__icon"></i>
        <h1 class="maintenance__title">{{ config('app.name') }}</h1>
        <p class="maintenance__message">
            {{ $message ?? __('We are currently performing scheduled maintenance. Please check back soon.') }}
        </p>
    </div>
</body>

</html>
