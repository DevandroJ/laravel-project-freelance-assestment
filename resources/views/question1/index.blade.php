@extends('layouts.app')

@section('title', 'Soal 1 — String Compression')

@section('content')
<div class="mb-6">
    <a href="/" class="text-sm text-gray-400 hover:text-blue-500">← Back to Home</a>
</div>

<div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <h1 class="text-xl font-bold text-gray-800 mb-1">Soal 1 — String Compression</h1>
    <p class="text-sm text-gray-500 mb-6">
        Counts total occurrences of each character, then outputs them sorted alphabetically.
        Characters appearing only once are shown without a number.
    </p>

    {{-- Form --}}
    <form method="POST" action="/soal-1" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Input String</label>
            <input
                type="text"
                name="input_string"
                value="{{ old('input_string', $input ?? 'aaabbcccddeddbzaa') }}"
                placeholder="e.g. aaabbcccddeddbzaa"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                required
            >
            @error('input_string')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
            Compress
        </button>
    </form>

    {{-- Result --}}
    @isset($output)
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-xs text-gray-500 mb-1">Input</p>
        <p class="font-mono text-sm text-gray-800 mb-3">{{ $input }}</p>
        <p class="text-xs text-gray-500 mb-1">Output</p>
        <p class="font-mono text-lg font-bold text-blue-700">{{ $output }}</p>
    </div>
    @endisset
</div>

{{-- Algorithm explanation --}}
<div class="mt-6 bg-white rounded-xl shadow p-6 border border-gray-100">
    <h2 class="text-sm font-semibold text-gray-700 mb-3">How it works</h2>
    <ol class="text-xs text-gray-500 space-y-1 list-decimal list-inside">
        <li>Loop through every character and tally its frequency.</li>
        <li>Sort the characters alphabetically (by key).</li>
        <li>Build the result: append character + count (omit count if = 1).</li>
    </ol>
    <p class="text-xs text-gray-400 mt-3">Example: <span class="font-mono">aaabbcccddeddbzaa</span> → a=5, b=3, c=3, d=4, e=1, z=1 → <span class="font-mono font-semibold">a5b3c3d4ez</span></p>
</div>
@endsection
