@extends('layouts.app')

@section('title', '503 Service Unavailable')

@section('content')
    <div class="w-full py-20 flex flex-col items-center text-center">

        <img src="{{ asset('images/errors/503.png') }}"
             alt="503"
             class="w-64 md:w-80 mb-8 opacity-90">

        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
            Service Unavailable
        </h1>

        <p class="text-gray-600 text-lg mb-8 max-w-md">
            Server sedang sibuk atau dalam mode maintenance.
            Silakan coba kembali beberapa saat lagi.
        </p>

        <a href="/"
           class="px-8 py-3 bg-blue-600 text-white rounded-full font-semibold shadow-md hover:bg-blue-700 transition">
            Kembali ke Beranda
        </a>
    </div>
@endsection
