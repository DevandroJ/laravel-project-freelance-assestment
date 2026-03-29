@extends('layouts.app')

@section('title', 'Soal 2 — Array Sorting')

@section('content')
<div class="mb-6">
    <a href="/" class="text-sm text-gray-400 hover:text-green-500">← Back to Home</a>
</div>

<div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <h1 class="text-xl font-bold text-gray-800 mb-1">Soal 2 — Array Sorting</h1>
    <p class="text-sm text-gray-500 mb-6">
        Sort the array from smallest to largest using loops and conditions only — no built-in sort functions.
        Algorithm: <strong>Insertion Sort</strong>.
    </p>

    {{-- Input array --}}
    <div class="mb-6">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Input Array</p>
        <div class="flex flex-wrap gap-2">
            @foreach ($input as $val)
                <span class="bg-gray-100 text-gray-700 font-mono text-sm px-3 py-1 rounded-full">{{ $val }}</span>
            @endforeach
        </div>
        <p class="text-xs text-gray-400 mt-2 font-mono">[{{ implode(', ', $input) }}]</p>
    </div>

    {{-- Arrow --}}
    <div class="text-center text-2xl text-gray-300 mb-6">↓</div>

    {{-- Sorted array --}}
    <div>
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Sorted Array</p>
        <div class="flex flex-wrap gap-2">
            @foreach ($sorted as $val)
                <span class="bg-green-100 text-green-700 font-mono text-sm px-3 py-1 rounded-full font-semibold">{{ $val }}</span>
            @endforeach
        </div>
        <p class="text-xs text-gray-400 mt-2 font-mono">[{{ implode(', ', $sorted) }}]</p>
    </div>
</div>

{{-- Algorithm explanation --}}
<div class="mt-6 bg-white rounded-xl shadow p-6 border border-gray-100">
    <h2 class="text-sm font-semibold text-gray-700 mb-3">Why Insertion Sort?</h2>
    <div class="grid grid-cols-3 gap-4 text-xs text-center">
        <div class="bg-gray-50 rounded-lg p-3">
            <p class="font-semibold text-gray-700">Time (worst)</p>
            <p class="text-gray-500 mt-1">O(n²)</p>
        </div>
        <div class="bg-green-50 rounded-lg p-3">
            <p class="font-semibold text-green-700">Time (best)</p>
            <p class="text-green-600 mt-1 font-bold">O(n)</p>
        </div>
        <div class="bg-blue-50 rounded-lg p-3">
            <p class="font-semibold text-blue-700">Extra Memory</p>
            <p class="text-blue-600 mt-1 font-bold">O(1)</p>
        </div>
    </div>
    <p class="text-xs text-gray-400 mt-3">Best-case O(n) means near-sorted inputs are handled efficiently — impossible with Bubble Sort (always O(n²)).</p>
</div>
@endsection
