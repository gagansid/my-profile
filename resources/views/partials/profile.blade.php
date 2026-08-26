<div class="profile__data">
    <div class="profile__border">
        <div class="profile__perfil">
            <div class="skeleton-wrapper is-loading">
                <img src="{{ $profile?->avatar_path ? asset('storage/'.$profile->avatar_path) : asset('favicon.png') }}" alt="{{ $profile?->name }}">
            </div>
        </div>
    </div>

    <h2 class="profile__name">{{ $profile?->name }}</h2>
    <h3 class="profile__profession">{{ $profile?->profession }}</h3>

    <ul class="profile__social">
        @foreach ($socialLinks as $link)
            <a href="{{ $link->url }}" target="_blank" rel="noopener" class="profile__social-link">
                <i class="{{ $link->icon }}"></i>
            </a>
        @endforeach
    </ul>
</div>

<div class="profile__info grid">
    <div class="profile__info-group">
        <h3 class="profile__info-number">{{ $profile?->years_experience }}</h3>
        <p class="profile__info-description">{{ __('profile.years_of_work') }}</p>
    </div>
    <div class="profile__info-group">
        <h3 class="profile__info-number">+{{ $profile?->completed_projects }}</h3>
        <p class="profile__info-description">{{ __('profile.completed_projects') }}</p>
    </div>
    <div class="profile__info-group">
        <h3 class="profile__info-number">{{ $profile?->satisfied_customers }}</h3>
        <p class="profile__info-description">{{ __('profile.satisfied_customers') }}</p>
    </div>
</div>

<div class="profile__buttons">
    @if ($profile?->cv_path)
        <a download href="{{ asset('storage/'.$profile->cv_path) }}" class="button">
            {{ __('profile.download_cv') }} <i class="ri-download-line"></i>
        </a>
    @endif
</div>
