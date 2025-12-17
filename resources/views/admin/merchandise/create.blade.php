@extends('layouts.admin')

@section('title', 'Create Merchandise')

@section('content')
    <div class="max-w-2xl mx-auto py-10">

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-6">
            Tambah Merchandise
        </h1>

        <form action="{{ route('admin.merchandise.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            <div>
                <label class="block font-semibold mb-1">
                    Nama Merchandise <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="w-full border-gray-300 rounded p-2"
                       required>
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea name="description"
                          rows="5"
                          class="w-full border-gray-300 rounded p-2"
                          required>{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Harga
                </label>
                <input type="number"
                       name="price"
                       value="{{ old('price') }}"
                       class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Upload Foto Produk <span class="text-red-500">*</span>
                </label>
                <input type="file"
                       name="image"
                       accept="image/png,image/jpeg"
                       class="w-full border-gray-300 rounded p-2"
                       required>
                <p class="text-sm text-gray-500 mt-1">
                    Format JPG / PNG, maksimal 2MB.
                </p>
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Link Pembelian
                </label>

                <div id="link-wrapper" class="space-y-3">
                    <div class="flex gap-3">
                        <input type="text"
                               name="shop_name[]"
                               placeholder="Nama Toko (Shopee, Tokopedia, dll)"
                               class="w-1/2 border-gray-300 rounded p-2">

                        <input type="url"
                               name="url[]"
                               placeholder="https://example.com"
                               class="w-1/2 border-gray-300 rounded p-2">
                    </div>
                </div>

                <button type="button"
                        id="add-link"
                        class="mt-2 text-sm text-blue-600 hover:underline">
                    + Tambah Link
                </button>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded font-semibold">
                    Simpan Merchandise
                </button>

                <a href="{{ route('admin.merchandise.index') }}"
                   class="text-gray-600 hover:underline">
                    Batal
                </a>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('add-link').addEventListener('click', function () {
            const wrapper = document.getElementById('link-wrapper');

            const row = document.createElement('div');
            row.classList.add('flex', 'gap-3');

            row.innerHTML = `
                <input type="text"
                       name="shop_name[]"
                       placeholder="Nama Toko"
                       class="w-1/2 border-gray-300 rounded p-2">

                <input type="url"
                       name="url[]"
                       placeholder="https://example.com"
                       class="w-1/2 border-gray-300 rounded p-2">
            `;

            wrapper.appendChild(row);
        });
    </script>
@endsection
