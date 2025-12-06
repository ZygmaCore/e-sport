@props([
    'title' => null,
    'image' => null,
    'link' => null,
])

<div class="rounded-lg overflow-hidden shadow bg-white">
    @if($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    @endif

    <div class="p-4">
        @if($title)
            <h3 class="text-lg font-semibold mb-2">{{ $title }}</h3>
        @endif

        <div class="text-gray-700">
            {{ $slot }}
        </div>

        @if($link)
            <a href="{{ $link }}" class="inline-block mt-3 text-blue-600 hover:text-blue-800">
                Read more →
            </a>
        @endif
    </div>
</div>
