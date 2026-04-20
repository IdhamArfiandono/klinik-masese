@extends('layouts.apoteker')
@section('title', 'Riwayat Transaksi')
@section('header', 'Riwayat Transaksi')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b flex flex-wrap gap-3 items-center">
        <form method="GET" class="flex gap-2 flex-wrap">
            <input type="date" name="from" value="{{ request('from') }}" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-400">
            <input type="date" name="to" value="{{ request('to') }}" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-400">
            <button class="bg-purple-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-purple-600">Filter</button>
            <a href="{{ route('apoteker.transactions.index') }}" class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50">Reset</a>
        </form>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3 text-gray-600">ID</th>
                <th class="text-left px-4 py-3 text-gray-600">Pasien</th>
                <th class="text-left px-4 py-3 text-gray-600">Tanggal</th>
                <th class="text-right px-4 py-3 text-gray-600">Total</th>
                <th class="text-center px-4 py-3 text-gray-600">Status</th>
                <th class="text-center px-4 py-3 text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-500">#{{ $trx->id }}</td>
                <td class="px-4 py-3 font-medium">{{ $trx->patient->user->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $trx->created_at->translatedFormat('d M Y') }}</td>
                <td class="px-4 py-3 text-right font-medium text-purple-700">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-1 rounded-full text-xs {{ $trx->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($trx->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center">
                    <a href="{{ route('apoteker.transactions.show', $trx) }}" class="text-purple-600 text-xs hover:underline">Detail</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">Tidak ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $transactions->withQueryString()->links() }}</div>
</div>
@endsection
