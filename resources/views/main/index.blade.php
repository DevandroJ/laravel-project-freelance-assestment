@extends('layouts.app')

@section('title', 'Backend Skill Test')

@section('content')
<div class="text-center mb-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Backend Skill Test</h1>
    <p class="text-gray-500">Laravel — 3 Questions</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Soal 1 --}}
    <a href="/soal-1" class="block bg-white rounded-xl shadow hover:shadow-md transition p-6 border border-gray-100 hover:border-blue-300">
        <div class="text-2xl mb-3">🔤</div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Soal 1</h2>
        <p class="text-sm text-gray-500">String Compression</p>
        <p class="text-xs text-gray-400 mt-2">Count character frequencies and output alphabetically sorted with counts.</p>
        <span class="inline-block mt-4 text-blue-600 text-sm font-medium">Try it →</span>
    </a>

    {{-- Soal 2 --}}
    <a href="/soal-2" class="block bg-white rounded-xl shadow hover:shadow-md transition p-6 border border-gray-100 hover:border-green-300">
        <div class="text-2xl mb-3">🔢</div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Soal 2</h2>
        <p class="text-sm text-gray-500">Array Sorting</p>
        <p class="text-xs text-gray-400 mt-2">Sort an array smallest to largest using loops and conditions only (Insertion Sort).</p>
        <span class="inline-block mt-4 text-green-600 text-sm font-medium">View Result →</span>
    </a>

    {{-- Soal 3 --}}
    <a href="/soal-3" class="block bg-white rounded-xl shadow hover:shadow-md transition p-6 border border-gray-100 hover:border-purple-300">
        <div class="text-2xl mb-3">💰</div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Soal 3</h2>
        <p class="text-sm text-gray-500">Price Calculator</p>
        <p class="text-xs text-gray-400 mt-2">Calculate final price with quantity and day-based discounts for Type A & B items.</p>
        <span class="inline-block mt-4 text-purple-600 text-sm font-medium">Calculate →</span>
    </a>

</div>
@endsection
