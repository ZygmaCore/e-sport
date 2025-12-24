@extends('layouts.app')

@section('title', 'Set Password Member')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow p-6">

            <h1 class="text-2xl font-semibold text-center mb-1 text-gray-800">
                Set Password
            </h1>

            <p class="text-sm text-gray-500 text-center mb-6">
                Buat password untuk mengaktifkan akun member
            </p>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('member.password.store', $token) }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-gray-700">
                        Email
                    </label>
                    <input
                        type="email"
                        value="{{ $email }}"
                        readonly
                        class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-600 cursor-not-allowed"
                    >
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-1 text-gray-700">
                        Password Baru
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        minlength="8"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500"
                        placeholder="Minimal 8 karakter"
                    >
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium mb-1 text-gray-700">
                        Konfirmasi Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        minlength="8"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500"
                        placeholder="Ulangi password"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition"
                >
                    Simpan Password & Masuk
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-gray-500">
                Link ini hanya dapat digunakan satu kali.
            </div>

        </div>
    </div>
@endsection
