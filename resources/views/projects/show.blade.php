@extends('layouts.public')

@section('seo')
    <x-seo :title="$project->title" :description="$project->description" :image="$project->thumbnail_path" />
@endsection

@section('content')
    <div class="mb-1">
        <a href="{{ route('projects.index') }}" class="button button__small button__gray">
            <i class="ri-arrow-left-line"></i> {{ __('projects.back') }}
        </a>
    </div>

    <div class="skeleton-wrapper is-loading" style="width:100%; max-height:360px; margin-bottom:1.5rem;">
        <img src="{{ $project->thumbnail_path ? asset('storage/'.$project->thumbnail_path) : asset('favicon.png') }}"
            alt="{{ $project->title }}" style="width:100%; object-fit:cover; border-radius:1rem;">
    </div>

    <div class="text-center mb-2">
        @if ($project->category)
            <span class="projects__subtitle" style="color:var(--first-color);">{{ $project->category->name }}</span>
        @endif
        <h2>{{ $project->title }}</h2>
    </div>

    <div class="abouts__area mb-2">
        <p class="abouts__summary">{{ $project->description }}</p>
    </div>

    @if ($project->technologies->isNotEmpty())
        <div class="mb-2">
            <h3 class="works__title">{{ __('projects.technologies') }}</h3>
            <hr>
            <div style="display:flex; flex-wrap:wrap; gap:.75rem; margin-top:1rem;">
                @foreach ($project->technologies as $technology)
                    <span class="button button__small button__gray">
                        @if ($technology->icon)
                            <i class="{{ $technology->icon }}"></i>
                        @endif
                        {{ $technology->name }}
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    @if ($project->tags->isNotEmpty())
        <div class="mb-2" style="display:flex; flex-wrap:wrap; gap:.5rem;">
            @foreach ($project->tags as $tag)
                <a href="{{ route('projects.index', ['tag' => $tag->slug]) }}" class="button button__small button__gray">#{{ $tag->name }}</a>
            @endforeach
        </div>
    @endif

    <div class="profile__buttons">
        @if ($project->demo_url)
            <a href="{{ $project->demo_url }}" target="_blank" rel="noopener" class="button">
                {{ __('projects.demo') }} <i class="ri-external-link-line"></i>
            </a>
        @endif
        @if ($project->repo_url)
            <a href="{{ $project->repo_url }}" target="_blank" rel="noopener" class="button button__gray">
                {{ __('projects.source_code') }} <i class="ri-github-line"></i>
            </a>
        @endif
    </div>
@endsection
