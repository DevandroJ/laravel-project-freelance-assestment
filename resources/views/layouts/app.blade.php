<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Backend Skill Test')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center gap-6">
            <a href="/" class="font-bold text-gray-800 hover:text-blue-600">🏠 Home</a>
            <a href="/soal-1" class="text-sm text-gray-600 hover:text-blue-600">Soal 1</a>
            <a href="/soal-2" class="text-sm text-gray-600 hover:text-blue-600">Soal 2</a>
            <a href="/soal-3" class="text-sm text-gray-600 hover:text-blue-600">Soal 3</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>
