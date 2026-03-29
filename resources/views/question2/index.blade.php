@extends('layouts.app')

@section('title', 'Soal 2 — Array Sorting')

@section('content')
<div class="mb-6">
    <a href="/" class="text-sm text-gray-400 hover:text-green-500">← Back to Home</a>
</div>

{{-- ── TRY YOUR OWN ARRAY ───────────────────────────────────────── --}}
<div class="bg-white rounded-xl shadow p-6 border border-gray-100 mb-6">
    <h2 class="text-base font-semibold text-gray-800 mb-1">Try Your Own Array</h2>
    <p class="text-xs text-gray-500 mb-4">Enter comma-separated integers (negatives allowed) and validate the sort logic yourself.</p>

    <form method="POST" action="/soal-2" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Custom Input</label>
            <input
                type="text"
                name="custom_array"
                value="{{ old('custom_array', isset($customInput) ? implode(', ', $customInput) : '') }}"
                placeholder="e.g. 5, 2, -3, 1, 8, -1, 0"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-green-400"
            >
            @error('custom_array')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-400 mt-1">Only integers and commas. Example: <span class="font-mono">5, 2, -3, 1, 8</span></p>
        </div>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
            Sort
        </button>
    </form>

    @isset($customInput)
    <div class="mt-5 space-y-4">
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Your Input</p>
            <div class="flex flex-wrap gap-2">
                @foreach ($customInput as $val)
                    <span class="bg-gray-100 text-gray-700 font-mono text-sm px-3 py-1 rounded-full">{{ $val }}</span>
                @endforeach
            </div>
        </div>
        <div class="text-center text-gray-300 text-xl">↓</div>
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Sorted Result</p>
            <div class="flex flex-wrap gap-2">
                @foreach ($customSorted as $val)
                    <span class="bg-green-100 text-green-700 font-mono text-sm px-3 py-1 rounded-full font-semibold">{{ $val }}</span>
                @endforeach
            </div>
            <p class="text-xs text-gray-400 mt-2 font-mono">[{{ implode(', ', $customSorted) }}]</p>
        </div>
        @if (min($customInput) < 0)
        <div class="bg-blue-50 border border-blue-100 rounded-lg px-4 py-2 text-xs text-blue-700">
            ✅ Negative numbers sorted correctly — Insertion Sort handles any integer range.
        </div>
        @endif
    </div>
    @endisset
</div>

{{-- ── PROBLEM STATEMENT EXAMPLE ───────────────────────────────── --}}
<div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <div class="flex items-center gap-2 mb-4">
        <h1 class="text-base font-semibold text-gray-800">Problem Statement Example</h1>
        <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">Soal 2 canonical answer</span>
    </div>
    <p class="text-xs text-gray-500 mb-4">
        Sort the array from smallest to largest using loops and conditions only — no built-in sort functions.
        Algorithm: <strong>Insertion Sort</strong>.
    </p>

    {{-- Input array --}}
    <div class="mb-4">
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
