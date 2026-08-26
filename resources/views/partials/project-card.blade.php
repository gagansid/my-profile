<article class="projects__card">
    <div class="skeleton-wrapper is-loading" style="width:100%;height:220px;">
        <img src="{{ $project->thumbnail_path ? asset('storage/'.$project->thumbnail_path) : asset('favicon.png') }}"
            alt="{{ $project->title }}" class="projects__img">
    </div>

    <div class="projects__modal">
        <div>
            @if ($project->category)
                <span class="projects__subtitle">{{ $project->category->name }}</span>
            @endif
            <h3 class="projects__title">{{ $project->title }}</h3>
            <a href="{{ route('projects.show', $project->slug) }}" class="projects__button button button__small">
                <i class="ri-link"></i>
            </a>
        </div>
    </div>
</article>
