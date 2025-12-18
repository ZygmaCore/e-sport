@extends('layouts.admin')

@section('title', 'Edit Merchandise')

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
            Edit Merchandise
        </h1>

        <form action="{{ route('admin.merchandise.update', $merchandise->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1">
                    Nama Merchandise <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $merchandise->name) }}"
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
                          required>{{ old('description', $merchandise->description) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Harga <span class="text-gray-500 text-sm">(Opsional)</span>
                </label>
                <input type="number"
                       name="price"
                       value="{{ old('price', $merchandise->price) }}"
                       class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Foto Produk Saat Ini
                </label>

                @if($merchandise->image)
                    <img src="{{ $merchandise->image_url }}"
                         alt="{{ $merchandise->name }}"
                         class="w-32 h-24 object-cover rounded border">
                @else
                    <p class="text-gray-400 italic">Tidak ada foto</p>
                @endif
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Ganti Foto Produk <span class="text-gray-500 text-sm">(Opsional)</span>
                </label>
                <input type="file"
                       name="image"
                       accept="image/png,image/jpeg"
                       class="w-full border-gray-300 rounded p-2">
                <p class="text-sm text-gray-500 mt-1">
                    Upload jika ingin mengganti foto lama.
                </p>
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Link Pembelian <span class="text-gray-500 text-sm">(Opsional)</span>
                </label>

                <div id="link-wrapper" class="space-y-3">

                    @forelse($merchandise->links as $link)
                        <div class="flex gap-3">
                            <input type="text"
                                   name="shop_name[]"
                                   value="{{ $link->shop_name }}"
                                   class="w-1/2 border-gray-300 rounded p-2">

                            <input type="url"
                                   name="url[]"
                                   value="{{ $link->url }}"
                                   class="w-1/2 border-gray-300 rounded p-2">
                        </div>
                    @empty
                        <div class="flex gap-3">
                            <input type="text"
                                   name="shop_name[]"
                                   placeholder="Nama Toko"
                                   class="w-1/2 border-gray-300 rounded p-2">

                            <input type="url"
                                   name="url[]"
                                   placeholder="https://example.com"
                                   class="w-1/2 border-gray-300 rounded p-2">
                        </div>
                    @endforelse

                </div>

                <button type="button"
                        id="add-link"
                        class="mt-2 text-sm text-blue-600 hover:underline">
                    + Tambah Link
                </button>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded font-semibold">
                    Simpan Perubahan
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
