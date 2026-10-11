@props(['direction' => 'up-right'])

@php
    $rotation = match ($direction) {
        'down' => 90,
        'left' => 180,
        'up' => -90,
        default => -45,
    };
@endphp

<svg {{ $attributes->merge(['class' => 'ui-icon']) }} viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false" style="transform: rotate({{ $rotation }}deg)">
    <path d="M2.5 8h10m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="square" stroke-linejoin="miter"/>
</svg>
