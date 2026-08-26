<button {{ $attributes->merge(['type' => 'submit', 'class' => 'button button__danger button__small']) }}>
    {{ $slot }}
</button>
