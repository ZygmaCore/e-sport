@props([
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $baseClasses = 'px-4 py-2 rounded font-semibold focus:outline-none transition';

    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'secondary' => 'bg-gray-200 text-gray-800 hover:bg-gray-300',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'success' => 'bg-green-600 text-white hover:bg-green-700',
        'outline' => 'border border-gray-400 text-gray-700 hover:bg-gray-100',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
