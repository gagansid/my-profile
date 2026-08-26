@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'admin-alert admin-alert--error']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
