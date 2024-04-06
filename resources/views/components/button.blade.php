@props(['color' => null])

<button {!! $attributes->merge(['type' => 'submit', 'class' => 'button ' . (!empty($color) ? 'button--' . $color : '')]) !!}>
    {{ $slot }}
</button>
