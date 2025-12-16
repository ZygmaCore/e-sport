@extends('layouts.admin')

@section('title', 'Admin News')

@section('content')
    <div class="container mx-auto px-4">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                News Management
            </h1>

            <a href="{{ route('admin.news.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Berita
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
                    <th class="px-4 py-3 border">Thumbnail</th>
                    <th class="px-4 py-3 border">Judul</th>
                    <th class="px-4 py-3 border">Status</th>
                    <th class="px-4 py-3 border">Tanggal Publikasi</th>
                    <th class="px-4 py-3 border">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($news as $item)
                    <tr class="text-sm text-gray-700">
                        <td class="px-4 py-3 border">
                            @if($item->thumbnail)
                                <img src="{{ $item->thumbnail_url }}"
                                     alt="Thumbnail"
                                     class="w-20 h-14 object-cover rounded">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 border">
                            <div class="font-medium">{{ $item->title }}</div>
                            <div class="text-xs text-gray-500">
                                Slug: {{ $item->slug }}
                            </div>
                        </td>

                        <td class="px-4 py-3 border">
                            @if($item->status === 'published')
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                                Published
                            </span>
                            @else
                                <span class="px-2 py-1 text-xs bg-gray-200 text-gray-600 rounded">
                                Draft
                            </span>
                            @endif
                        </td>

                        <td class="px-4 py-3 border">
                            {{ $item->published_at?->format('d M Y H:i') ?? '-' }}
                        </td>

                        <td class="px-4 py-3 border space-x-2 whitespace-nowrap">

                            <form action="{{ route('admin.news.toggle', $item->id) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                <button type="submit"
                                        class="text-sm {{ $item->status === 'published'
                                        ? 'text-yellow-600 hover:underline'
                                        : 'text-green-600 hover:underline' }}">
                                    {{ $item->status === 'published' ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>

                            <a href="{{ route('admin.news.edit', $item->id) }}"
                               class="text-blue-600 hover:underline text-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.news.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Yakin hapus berita ini?')">
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
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data berita.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $news->links() }}
        </div>

    </div>
@endsection
