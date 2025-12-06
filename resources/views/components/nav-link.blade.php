@props([
    'href' => '#',
    'active' => false,
])

@php
    $classes = $active 
        ? 'flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700'
        : 'flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <span>{{ $slot }}</span>
</a>
