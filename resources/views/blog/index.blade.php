@extends('layouts.public')

@section('seo')
    <x-seo :title="__('blog.title')" />
@endsection

@section('content')
    <div class="text-center mb-2">
        <h2>{{ __('blog.title') }}</h2>
    </div>

    <div data-ajax-region="blog-list">
        @if ($categories->isNotEmpty() || $tags->isNotEmpty())
            <div class="mb-2" style="display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;">
                <a href="{{ route('blog.index') }}"
                    class="button button__small {{ request()->missing('category') && request()->missing('tag') ? '' : 'button__gray' }}">
                    {{ __('blog.all_categories') }}
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                        class="button button__small {{ request('category') === $category->slug ? '' : 'button__gray' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
                @foreach ($tags as $tag)
                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                        class="button button__small {{ request('tag') === $tag->slug ? '' : 'button__gray' }}">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($posts->isEmpty())
            <p class="text-center">{{ __('blog.empty') }}</p>
        @else
            @foreach ($posts as $post)
                <article class="works__area mb-2">
                    @if ($post->category)
                        <span class="projects__subtitle" style="color:var(--first-color);">{{ $post->category->name }}</span>
                    @endif
                    <h3 class="works__company">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="works__description">{{ $post->excerpt }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="button button__small button__gray">{{ __('blog.read_more') }}</a>
                </article>
            @endforeach

            <div class="mt-2">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
