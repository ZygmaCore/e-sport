@props([
    'label' => '',
    'name' => null,
    'type' => 'text',
    'value' => null,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block font-semibold mb-1">
            {{ $label }}
        </label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ $value }}"
        {{ $attributes->merge([
            'class' =>
                'w-full border rounded px-3 py-2 focus:outline-none focus:ring ' .
                ($errors->has($name) ? 'border-red-500' : 'border-gray-300')
        ]) }}
    >

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
