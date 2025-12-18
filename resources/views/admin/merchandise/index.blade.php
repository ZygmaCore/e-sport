@extends('layouts.admin')

@section('title', 'Admin Merchandise')

@section('content')
    <div class="container mx-auto px-4">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Merchandise Management
            </h1>

            <a href="{{ route('admin.merchandise.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Merchandise
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                <tr class="text-left text-sm text-gray-600">
                    <th class="px-4 py-3 border">Foto</th>
                    <th class="px-4 py-3 border">Nama</th>
                    <th class="px-4 py-3 border">Harga</th>
                    <th class="px-4 py-3 border">Link</th>
                    <th class="px-4 py-3 border">Dibuat Oleh</th>
                    <th class="px-4 py-3 border">Aksi</th>
                </tr>
                </thead>

                <tbody>
                @forelse($merchandise as $item)
                    <tr class="text-sm text-gray-700">

                        <td class="px-4 py-3 border">
                            @if($item->image)
                                <img src="{{ $item->image_url }}"
                                     alt="{{ $item->name }}"
                                     class="w-20 h-14 object-cover rounded">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 border">
                            <div class="font-medium">{{ $item->name }}</div>
                            <div class="text-xs text-gray-500">
                                Slug: {{ $item->slug }}
                            </div>
                        </td>

                        <td class="px-4 py-3 border">
                            @if($item->price)
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 border">
                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">
                                {{ $item->links->count() }} link
                            </span>
                        </td>

                        <td class="px-4 py-3 border">
                            {{ $item->creator->name ?? '-' }}
                        </td>

                        <td class="px-4 py-3 border space-x-3 whitespace-nowrap">

                            <a href="{{ route('admin.merchandise.edit', $item->id) }}"
                               class="text-blue-600 hover:underline text-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.merchandise.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Yakin hapus merchandise ini? Data, gambar, dan link akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline text-sm">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data merchandise.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $merchandise->links() }}
        </div>

    </div>
@endsection
