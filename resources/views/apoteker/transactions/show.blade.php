@extends('layouts.apoteker')
@section('title', 'Detail Transaksi')
@section('header', 'Detail Transaksi')

@section('content')
<div class="max-w-2xl" id="struk">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="text-center border-b pb-4 mb-4">
            <h2 class="font-bold text-lg">KLINIK & APOTEK MARI SEHAT SELALU</h2>
            <p class="text-sm text-gray-500">Jl. Sehat Raya No. 10, Jakarta Selatan</p>
            <p class="text-xs text-gray-400 mt-1">Struk Transaksi #{{ $transaction->id }}</p>
        </div>

        <dl class="space-y-2 text-sm mb-4">
            <div class="flex justify-between"><dt class="text-gray-500">Pasien</dt><dd class="font-medium">{{ $transaction->patient->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Tanggal</dt><dd>{{ $transaction->created_at->translatedFormat('d F Y H:i') }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Apoteker</dt><dd>{{ $transaction->apoteker->name }}</dd></div>
            @if($transaction->medicalRecord)
            <div class="flex justify-between"><dt class="text-gray-500">Dokter</dt><dd>{{ $transaction->medicalRecord->doctor->user->name }}</dd></div>
            @endif
        </dl>

        <table class="w-full text-sm border-t pt-3">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2 text-gray-600">Obat</th>
                    <th class="text-center py-2 text-gray-600">Qty</th>
                    <th class="text-right py-2 text-gray-600">Harga</th>
                    <th class="text-right py-2 text-gray-600">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->items as $item)
                <tr class="border-b">
                    <td class="py-2">{{ $item->medicine->name }}</td>
                    <td class="text-center py-2">{{ $item->quantity }} {{ $item->medicine->unit }}</td>
                    <td class="text-right py-2">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-right py-2 font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right font-bold pt-3">TOTAL</td>
                    <td class="text-right font-bold pt-3 text-purple-700 text-lg">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="text-center mt-6 text-xs text-gray-400">
            <p>Terima kasih telah mempercayakan kesehatan Anda kepada kami.</p>
            <p class="mt-1">Status: <span class="font-medium text-green-600">{{ strtoupper($transaction->status) }}</span></p>
        </div>
    </div>

    <div class="mt-4 flex gap-3">
        <button onclick="window.print()" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 text-sm">
            Cetak Struk
        </button>
        <a href="{{ route('apoteker.transactions.index') }}" class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Kembali</a>
    </div>
</div>
@endsection
