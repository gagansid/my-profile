@extends('layouts.public')

@section('seo')
    <x-seo :title="config('app.name')" :description="$profile?->summary" :image="$profile?->avatar_path" />
@endsection

@section('content')
    <div class="text-center mb-2">
        <h2>{{ __('about.title') }}</h2>
    </div>
    <div class="abouts__area mb-2">
        <p class="abouts__summary">{{ $profile?->summary }}</p>
    </div>

    <div class="mb-2">
        <a href="{{ route('about') }}" class="button">{{ __('nav.about') }} <i class="ri-arrow-right-line"></i></a>
    </div>

    @if ($projects->isNotEmpty())
        <div class="works__area mb-2">
            <h2 class="works__title">{{ __('projects.title') }}</h2>
            <hr>
            <div class="projects__content grid">
                @foreach ($projects as $project)
                    @include('partials.project-card', ['project' => $project])
                @endforeach
            </div>
            <div class="text-center mt-1">
                <a href="{{ route('projects.index') }}" class="button button__small">{{ __('projects.title') }}</a>
            </div>
        </div>
    @endif

    @if ($posts->isNotEmpty())
        <div class="works__area">
            <h2 class="works__title">{{ __('blog.title') }}</h2>
            <hr>
            @foreach ($posts as $post)
                <div class="mb-1">
                    <h3 class="works__company">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="works__description">{{ $post->excerpt }}</p>
                </div>
            @endforeach
            <div class="text-center mt-1">
                <a href="{{ route('blog.index') }}" class="button button__small">{{ __('blog.title') }}</a>
            </div>
        </div>
    @endif
@endsection
