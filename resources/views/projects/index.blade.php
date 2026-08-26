@extends('layouts.public')

@section('seo')
    <x-seo :title="__('projects.title')" />
@endsection

@section('content')
    <div class="text-center mb-2">
        <h2>{{ __('projects.title') }}</h2>
    </div>

    <div data-ajax-region="projects-list">
        @if ($categories->isNotEmpty() || $tags->isNotEmpty())
            <div class="mb-2" style="display:flex; flex-wrap:wrap; gap:.5rem; justify-content:center;">
                <a href="{{ route('projects.index') }}"
                    class="button button__small {{ request()->missing('category') && request()->missing('tag') ? '' : 'button__gray' }}">
                    {{ __('projects.all_categories') }}
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('projects.index', ['category' => $category->slug]) }}"
                        class="button button__small {{ request('category') === $category->slug ? '' : 'button__gray' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
                @foreach ($tags as $tag)
                    <a href="{{ route('projects.index', ['tag' => $tag->slug]) }}"
                        class="button button__small {{ request('tag') === $tag->slug ? '' : 'button__gray' }}">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($projects->isEmpty())
            <p class="text-center">{{ __('projects.empty') }}</p>
        @else
            <div class="projects__content grid">
                @foreach ($projects as $project)
                    @include('partials.project-card', ['project' => $project])
                @endforeach
            </div>

            <div class="mt-2">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
@endsection
