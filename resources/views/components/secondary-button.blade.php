<button {{ $attributes->merge(['type' => 'button', 'class' => 'button button__gray button__small']) }}>
    {{ $slot }}
</button>
