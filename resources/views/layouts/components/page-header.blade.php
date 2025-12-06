@props([
    'title' => null,
    'subtitle' => null,
    'image' => null,
    'alt' => null,
])

<div class="w-full mb-6">
    @if($image)
        <div class="relative h-48 w-full rounded-lg overflow-hidden mb-4">
            <img src="{{ $image }}" alt="{{ $alt }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
            <h1 class="absolute bottom-3 left-4 text-3xl font-bold text-white">
                {{ $title }}
            </h1>
        </div>
    @else
        <h1 class="text-3xl font-bold text-gray-900">{{ $title }}</h1>
    @endif

    @if($subtitle)
        <p class="text-gray-600 mt-2">
            {{ $subtitle }}
        </p>
    @endif
</div>
