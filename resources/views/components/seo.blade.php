@props([
    'title' => config('app.name'),
    'description' => null,
    'image' => null,
])

@php
    $fullTitle = $title === config('app.name') ? $title : $title.' — '.config('app.name');
    $description = $description ?? __('about.title');
    $image = $image ? asset('storage/'.$image) : asset('favicon.png');
@endphp

<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">

<meta property="og:type" content="website">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{ url()->current() }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
