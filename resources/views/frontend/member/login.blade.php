@extends('layouts.app')

@section('title', 'Login Member')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow p-6">

            <h1 class="text-2xl font-semibold text-center mb-1 text-gray-800">
                Login Member
            </h1>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('member.login.submit') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1 text-gray-700">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500"
                        placeholder="email@example.com"
                    >
                </div>

                <div class="mb-2">
                    <label for="password" class="block text-sm font-medium mb-1 text-gray-700">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500"
                        placeholder="Password"
                    >
                </div>

                <div class="mb-6 text-right">
                    <a
                        href="{{ route('member.password.forgot') }}"
                        class="text-xs text-blue-600 hover:underline"
                    >
                        Lupa password?
                    </a>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition"
                >
                    Login
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('member.register') }}" class="text-blue-600 hover:underline">
                    Daftar Member
                </a>
            </div>

        </div>
    </div>
@endsection
