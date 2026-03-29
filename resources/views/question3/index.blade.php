@extends('layouts.app')

@section('title', 'Soal 3 — Price Calculator')

@php
$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
$typeADays = ['Monday','Thursday'];
$typeBDays = ['Friday'];
@endphp

@section('content')
<div class="mb-6">
    <a href="/" class="text-sm text-gray-400 hover:text-purple-500">← Back to Home</a>
</div>

{{-- ── DISCOUNT PREVIEW TABLE ───────────────────────────────────── --}}
<div class="bg-white rounded-xl shadow p-6 border border-gray-100 mb-6">
    <h2 class="text-base font-semibold text-gray-800 mb-1">Discount Preview — By Day</h2>
    <p class="text-xs text-gray-500 mb-4">Use this table to plan your test cases before calculating.</p>
    <div class="overflow-x-auto">
        <table class="w-full text-xs text-center">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="py-2 px-3 text-left text-gray-600 font-medium">Day</th>
                    <th class="py-2 px-3 text-gray-600 font-medium">Type A day discount<br><span class="font-normal text-gray-400">(on top of qty discount)</span></th>
                    <th class="py-2 px-3 text-gray-600 font-medium">Type B day discount<br><span class="font-normal text-gray-400">(on top of qty discount)</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($days as $day)
                <tr class="{{ $day === $actualDay ? 'bg-yellow-50' : '' }}">
                    <td class="py-2 px-3 text-left font-medium text-gray-700">
                        {{ $day }}
                        @if ($day === $actualDay)
                            <span class="ml-1 text-yellow-600 text-xs">(today)</span>
                        @endif
                    </td>
                    <td class="py-2 px-3 {{ in_array($day, $typeADays) ? 'text-green-600 font-semibold' : 'text-gray-400' }}">
                        {{ in_array($day, $typeADays) ? '+10%' : '—' }}
                    </td>
                    <td class="py-2 px-3 {{ in_array($day, $typeBDays) ? 'text-green-600 font-semibold' : 'text-gray-400' }}">
                        {{ in_array($day, $typeBDays) ? '+5%' : '—' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p class="text-xs text-gray-400 mt-3">Qty discount: Type A qty&gt;50 = +5% &nbsp;|&nbsp; Type B qty&gt;100 = +10%. Day discount stacks on top. Max total = 15%.</p>
</div>

{{-- ── CALCULATOR FORM ──────────────────────────────────────────── --}}
<div class="bg-white rounded-xl shadow p-6 border border-gray-100">
    <h1 class="text-xl font-bold text-gray-800 mb-1">Soal 3 — Price Calculator</h1>
    <p class="text-sm text-gray-500 mb-5">Input: tipe barang + jumlah barang → Output: harga akhir</p>

    {{-- Day status banners --}}
    <div class="flex flex-wrap items-center gap-2 mb-6">
        <div class="inline-flex items-center gap-1 bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs px-3 py-1 rounded-full">
            📅 Actual today: <strong>{{ $actualDay }}</strong>
        </div>
        @if ($selectedDay !== $actualDay)
        <div class="inline-flex items-center gap-1 bg-orange-50 border border-orange-200 text-orange-700 text-xs px-3 py-1 rounded-full">
            ⚠️ Overriding to: <strong>{{ $selectedDay }}</strong>
        </div>
        @endif
    </div>

    {{-- Form --}}
    <form method="POST" action="/soal-3" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Type --}}
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

            {{-- Quantity --}}
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

            {{-- Day override --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Day
                    <span class="ml-1 text-xs font-normal text-orange-500 bg-orange-50 border border-orange-200 px-1.5 py-0.5 rounded">testing override</span>
                </label>
                <select name="day" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                    @foreach ($days as $day)
                    <option value="{{ $day }}" {{ $selectedDay === $day ? 'selected' : '' }}>
                        {{ $day }}{{ $day === $actualDay ? ' (today)' : '' }}
                    </option>
                    @endforeach
                </select>
                @error('day')
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
                    <td class="py-2 text-gray-600">Day Used</td>
                    <td class="py-2 font-medium text-gray-800 text-right">
                        {{ $result['day'] }}
                        @if ($result['day'] !== $actualDay)
                            <span class="text-xs text-orange-500 ml-1">(override)</span>
                        @endif
                    </td>
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
