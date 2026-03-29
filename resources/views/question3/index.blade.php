@extends('layouts.app')

@section('title', 'Soal 3 — Price Calculator')

@section('content')
<div class="mb-6">
    <a href="/" class="text-sm text-gray-400 hover:text-purple-500">← Back to Home</a>
</div>

<div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <h1 class="text-xl font-bold text-gray-800 mb-1">Soal 3 — Price Calculator</h1>
    <p class="text-sm text-gray-500 mb-1">Calculate the final price based on item type and quantity.</p>

    {{-- Today indicator --}}
    <div class="inline-flex items-center gap-2 bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs px-3 py-1 rounded-full mb-6">
        📅 Today is <strong>{{ $today }}</strong>
        @if (in_array($today, ['Monday', 'Thursday']))
            — Type A day discount applies (+10%)
        @elseif ($today === 'Friday')
            — Type B day discount applies (+5%)
        @endif
    </div>

    {{-- Discount rules quick reference --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-xs">
        <div class="bg-blue-50 border border-blue-100 rounded-lg p-3">
            <p class="font-semibold text-blue-700 mb-1">Type A — Rp 99.900 / unit</p>
            <p class="text-gray-500">• qty &gt; 50 → 5% discount</p>
            <p class="text-gray-500">• Monday or Thursday → +10% discount</p>
        </div>
        <div class="bg-purple-50 border border-purple-100 rounded-lg p-3">
            <p class="font-semibold text-purple-700 mb-1">Type B — Rp 49.900 / unit</p>
            <p class="text-gray-500">• qty &gt; 100 → 10% discount</p>
            <p class="text-gray-500">• Friday → +5% discount</p>
        </div>
    </div>

    {{-- Form --}}
    <form method="POST" action="/soal-3" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Barang</label>
                <select name="type" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                    <option value="">-- Select --</option>
                    <option value="A" {{ (isset($result) && $result['type'] === 'A') ? 'selected' : '' }}>Type A (Rp 99.900)</option>
                    <option value="B" {{ (isset($result) && $result['type'] === 'B') ? 'selected' : '' }}>Type B (Rp 49.900)</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Barang</label>
                <input
                    type="number"
                    name="quantity"
                    value="{{ isset($result) ? $result['quantity'] : old('quantity') }}"
                    placeholder="e.g. 51"
                    min="1"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
                    required
                >
                @error('quantity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
            Calculate Price
        </button>
    </form>

    {{-- Result --}}
    @isset($result)
    <div class="mt-6 p-4 bg-purple-50 border border-purple-200 rounded-lg">
        <p class="text-sm font-semibold text-purple-800 mb-3">Price Breakdown</p>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-purple-100">
                <tr>
                    <td class="py-2 text-gray-600">Type</td>
                    <td class="py-2 font-medium text-gray-800 text-right">Type {{ $result['type'] }}</td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Quantity</td>
                    <td class="py-2 font-medium text-gray-800 text-right">{{ number_format($result['quantity']) }} pcs</td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Base Price / unit</td>
                    <td class="py-2 font-medium text-gray-800 text-right">Rp {{ number_format($result['base_price'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Base Total</td>
                    <td class="py-2 font-medium text-gray-800 text-right">Rp {{ number_format($result['base_price'] * $result['quantity'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Qty Discount</td>
                    <td class="py-2 text-right {{ $result['qty_discount_percent'] > 0 ? 'text-green-600 font-medium' : 'text-gray-400' }}">
                        {{ $result['qty_discount_percent'] > 0 ? '-' . $result['qty_discount_percent'] . '%' : '—' }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Day Discount ({{ $result['day'] }})</td>
                    <td class="py-2 text-right {{ $result['day_discount_percent'] > 0 ? 'text-green-600 font-medium' : 'text-gray-400' }}">
                        {{ $result['day_discount_percent'] > 0 ? '-' . $result['day_discount_percent'] . '%' : '—' }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Total Discount</td>
                    <td class="py-2 text-right {{ $result['total_discount_percent'] > 0 ? 'text-green-600 font-semibold' : 'text-gray-400' }}">
                        {{ $result['total_discount_percent'] > 0 ? '-' . $result['total_discount_percent'] . '%' : '—' }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Discount Amount</td>
                    <td class="py-2 text-green-600 font-medium text-right">- Rp {{ number_format($result['discount_amount'], 0, ',', '.') }}</td>
                </tr>
                <tr class="border-t-2 border-purple-300">
                    <td class="py-3 font-bold text-gray-800">Final Price</td>
                    <td class="py-3 font-bold text-purple-700 text-right text-lg">Rp {{ number_format($result['final_price'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endisset
</div>
@endsection
