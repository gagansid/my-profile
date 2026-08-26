@props([
    'title' => null,
    'description' => null,
    'formAction' => null,
    'formMethod' => 'POST',
    'formEnctype' => null,
])

@php
    $httpMethod = strtoupper($formMethod);
    $spoofMethod = $formAction && ! in_array($httpMethod, ['GET', 'POST'], true);
@endphp

<div {{ $attributes->merge(['class' => 'admin-card']) }}>
    @if ($title || $description || isset($header))
        <div class="admin-card__header">
            @if ($title)
                <h2 class="admin-card__title">{{ $title }}</h2>
            @endif
            @if ($description)
                <p class="admin-card__description">{{ $description }}</p>
            @endif
            {{ $header ?? '' }}
        </div>
    @endif

    @if ($formAction)
        <form method="{{ $spoofMethod ? 'POST' : $httpMethod }}" action="{{ $formAction }}"
            @if ($formEnctype) enctype="{{ $formEnctype }}" @endif>
            @csrf
            @if ($spoofMethod)
                @method($httpMethod)
            @endif

            <div class="admin-card__body">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="admin-card__footer">
                    {{ $footer }}
                </div>
            @endisset
        </form>
    @else
        <div class="admin-card__body">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="admin-card__footer">
                {{ $footer }}
            </div>
        @endisset
    @endif
</div>
