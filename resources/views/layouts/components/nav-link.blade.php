@props([
    'href' => '#',
    'active' => false,
    'mobile' => false,
    'admin' => false,
])

@props([
    'href' => '#',
    'active' => false,
    'mobile' => false,
    'admin' => false,
])

@php
    if ($mobile) {
        // Mobile Admin
        if ($admin) {
            $classes = $active
                ? 'px-8 py-2 bg-black/30 font-semibold'
                : 'px-8 py-2 hover:bg-black/20 font-semibold';
        }
        // Mobile User
        else {
            $classes = $active
                ? 'px-8 py-2 bg-slate-200 hover:bg-slate-300 font-medium'
                : 'px-8 py-2 bg-white hover:bg-slate-300';
        }
    } 
    else {
        // Desktop Admin
        if ($admin) {
            $classes = $active
                ? 'text-gray-100 font-medium hover:text-white'
                : 'text-gray-400 hover:text-gray-300';
        }
        // Desktop User
        else {
            $classes = $active
                ? 'text-blue-600 hover:underline'
                : 'text-gray-700 hover:text-blue-700';
        }
    }
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center '.$classes]) }}>
    <span>{{ $slot }}</span>
</a>
