@extends('layouts.public')

@section('seo')
    <x-seo :title="$post->title" :description="$post->excerpt" :image="$post->thumbnail_path" />
@endsection

@section('content')
    <div class="mb-1">
        <a href="{{ route('blog.index') }}" class="button button__small button__gray">
            <i class="ri-arrow-left-line"></i> {{ __('blog.back') }}
        </a>
    </div>

    @if ($post->thumbnail_path)
        <div class="skeleton-wrapper is-loading" style="width:100%; max-height:360px; margin-bottom:1.5rem;">
            <img src="{{ asset('storage/'.$post->thumbnail_path) }}" alt="{{ $post->title }}"
                style="width:100%; object-fit:cover; border-radius:1rem;">
        </div>
    @endif

    <div class="text-center mb-2">
        @if ($post->category)
            <span class="projects__subtitle" style="color:var(--first-color);">{{ $post->category->name }}</span>
        @endif
        <h2>{{ $post->title }}</h2>
        <p class="works__description">{{ __('blog.published_on') }} {{ $post->published_at?->format('d M Y') }}</p>
    </div>

    <div class="abouts__area mb-2">
        {!! $contentHtml !!}
    </div>

    @if ($post->tags->isNotEmpty())
        <div class="mb-2" style="display:flex; flex-wrap:wrap; gap:.5rem;">
            @foreach ($post->tags as $tag)
                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="button button__small button__gray">#{{ $tag->name }}</a>
            @endforeach
        </div>
    @endif
@endsection
