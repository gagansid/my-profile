<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite(['resources/scss/styles.scss'])
    <title>{{ config('app.name') }} — 500</title>
    <meta name="robots" content="noindex">
</head>

<body>
    <div class="maintenance container">
        <i class="ri-error-warning-line maintenance__icon"></i>
        <h1 class="maintenance__title">500</h1>
        <p class="maintenance__message">
            {{ __('Something went wrong on our end. Please try again shortly.') }}
        </p>
        <a href="{{ url('/') }}" class="button">{{ __('nav.home') }}</a>
    </div>
</body>

</html>
