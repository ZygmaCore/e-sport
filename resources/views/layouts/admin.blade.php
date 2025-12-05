<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

<header class="bg-gray-800 text-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-lg font-semibold">Admin Panel</h1>

        <nav class="space-x-6">
            <a href="/admin/dashboard" class="hover:text-gray-300">Dashboard</a>
            <a href="/admin/news" class="hover:text-gray-300">News</a>
            <a href="/admin/applications" class="hover:text-gray-300">Applications</a>
            <a href="/admin/merchandise" class="hover:text-gray-300">Merchandise</a>

            <form action="/admin/logout" method="POST" class="inline">
                @csrf
                <button class="hover:text-red-400">Logout</button>
            </form>
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-6">
    @yield('content')
</main>

</body>
</html>
