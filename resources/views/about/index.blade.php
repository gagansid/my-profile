@extends('layouts.public')

@section('seo')
    <x-seo :title="__('about.title')" :description="$profile?->summary" :image="$profile?->avatar_path" />
@endsection

@section('content')
    <div class="text-center mb-2">
        <h2>{{ __('about.title') }}</h2>
    </div>
    <div class="abouts__area mb-2">
        <p class="abouts__summary">{{ $profile?->summary }}</p>
    </div>

    @if ($experiences->isNotEmpty())
        <div class="works__area mb-2">
            <h2 class="works__title">{{ __('about.work_experience') }}</h2>
            <hr>
            @foreach ($experiences as $experience)
                <div class="mb-1">
                    <h3 class="works__company">
                        {{ $experience->company }}
                        <span>
                            ({{ $experience->start_date->format('M Y') }} -
                            {{ $experience->end_date?->format('M Y') ?? __('about.present') }})
                        </span>
                    </h3>
                    <h3 class="works__name">{{ $experience->position }}</h3>
                    <div class="works__description">
                        <ul style="list-style-type: circle; text-align: justify;">
                            @foreach (explode("\n", (string) $experience->description) as $line)
                                @continue(trim($line) === '')
                                <li>{{ $line }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($educations->isNotEmpty())
        <div class="works__area mb-2">
            <h2 class="works__title">{{ __('about.education') }}</h2>
            <hr>
            @foreach ($educations as $education)
                <div>
                    <h3>
                        {{ $education->institution }}
                        <span>
                            ({{ $education->start_date->format('M Y') }} -
                            {{ $education->end_date?->format('M Y') ?? __('about.present') }})
                        </span>
                    </h3>
                    <span>{{ $education->degree }}@if($education->score), {{ $education->score }}@endif</span>
                </div>
            @endforeach
        </div>
    @endif

    @if ($skills->isNotEmpty())
        <div>
            <h2 class="works__title">{{ __('about.skills') }}</h2>
            <hr>
            <div>
                @foreach (['frontend' => __('about.frontend'), 'backend' => __('about.backend'), 'other' => __('about.other')] as $category => $label)
                    @continue(! isset($skills[$category]))
                    <h3>{{ $label }}</h3>
                    <p style="margin-bottom: .5rem;">{{ $skills[$category]->pluck('name')->join(', ') }}</p>
                @endforeach
            </div>
        </div>
    @endif
@endsection
