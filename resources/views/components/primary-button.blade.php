<button {{ $attributes->merge(['type' => 'submit', 'class' => 'button button__small']) }}>
    {{ $slot }}
</button>
