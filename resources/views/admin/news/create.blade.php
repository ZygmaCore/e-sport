@extends('layouts.admin')

@section('title', 'Create News')

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
            Tambah Berita
        </h1>

        <form action="{{ route('admin.news.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            <div>
                <label class="block font-semibold mb-1">
                    Judul Berita <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full border-gray-300 rounded p-2"
                       required>
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Ringkasan <span class="text-red-500">*</span>
                </label>
                <textarea name="summary"
                          rows="3"
                          class="w-full border-gray-300 rounded p-2"
                          placeholder="maks. 300 karakter">{{ old('summary') }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Isi Berita <span class="text-red-500">*</span>
                </label>
                <textarea name="content"
                          rows="8"
                          class="w-full border-gray-300 rounded p-2"
                          required>{{ old('content') }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Upload Thumbnail <span class="text-red-500">*</span>
                </label>
                <input type="file"
                       name="thumbnail"
                       accept="image/png,image/jpeg"
                       class="w-full border-gray-300 rounded p-2"
                       required>
                <p class="text-sm text-gray-500 mt-1">
                    Format JPG / PNG, maksimal 2MB.
                </p>
            </div>

            <div>
                <label class="block font-semibold mb-1">
                    Tanggal Publikasi <span class="text-red-500">*</span>
                </label>
                <input type="datetime-local"
                       name="published_at"
                       value="{{ old('published_at') }}"
                       class="w-full border-gray-300 rounded p-2"
                       required>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded font-semibold">
                    Simpan Berita
                </button>

                <a href="{{ route('admin.news.index') }}"
                   class="text-gray-600 hover:underline">
                    Batal
                </a>
            </div>

        </form>
    </div>
@endsection
