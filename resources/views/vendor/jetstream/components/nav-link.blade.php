@props(['active'])

@php
$classes = ($active ?? false)
            ? 'top-menu top-menu--active'
            : 'top-menu';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
