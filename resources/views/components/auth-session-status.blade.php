@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'admin-alert admin-alert--success']) }}>
        {{ $status }}
    </div>
@endif
