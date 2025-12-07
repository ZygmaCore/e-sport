@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <article class="max-w-4xl mx-auto">
        <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 mb-6">
            ← Back to all news
        </a>

        <h1 class="text-4xl font-bold text-gray-900 leading-tight">{{ $news->title }}</h1>
        <p class="text-gray-500 mt-2">Published on {{ $news->published_at ?? '-' }}</p>

        <div class="mt-6">
            <img src="{{ $news->thumbnail_url }}" alt="{{ $news->title }}" class="w-full h-80 object-cover rounded-xl shadow">
        </div>

        <p class="mt-6 text-lg text-gray-700 leading-relaxed">
            {{ $news->content }}
        </p>
    </article>
@endsection
