@extends('layouts.apoteker')
@section('title', 'Detail Resep')
@section('header', 'Detail Resep')

@section('content')
<div class="max-w-2xl space-y-5">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold mb-4">Informasi Pasien & Resep</h2>
        <dl class="space-y-2 text-sm mb-4">
            <div class="flex justify-between"><dt class="text-gray-500">Pasien</dt><dd class="font-medium">{{ $medicalRecord->patient->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Dokter</dt><dd>{{ $medicalRecord->doctor->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Tanggal Resep</dt><dd>{{ $medicalRecord->created_at->translatedFormat('d F Y H:i') }}</dd></div>
            <div><dt class="text-gray-500 mb-1">Diagnosis</dt><dd class="bg-gray-50 p-3 rounded-lg text-xs">{{ $medicalRecord->diagnosis }}</dd></div>
        </dl>

        <h3 class="font-medium text-gray-700 mb-3">Daftar Obat</h3>
        @php $total = 0; @endphp
        @foreach($medicalRecord->prescriptions as $p)
        @php $subtotal = $p->medicine->price * $p->quantity; $total += $subtotal; @endphp
        <div class="flex items-center justify-between bg-purple-50 rounded-lg p-3 mb-2 text-sm">
            <div>
                <p class="font-medium">{{ $p->medicine->name }}</p>
                <p class="text-gray-500">{{ $p->dosage }} | Stok: {{ $p->medicine->stock }}</p>
            </div>
            <div class="text-right">
                <p>{{ $p->quantity }} {{ $p->medicine->unit }}</p>
                <p class="text-purple-700 font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
            </div>
        </div>
        @endforeach

        <div class="flex justify-between font-bold text-lg mt-4 pt-4 border-t">
            <span>Total</span>
            <span class="text-purple-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
    </div>

    @if(!$medicalRecord->transaction)
    <form method="POST" action="{{ route('apoteker.prescriptions.process', $medicalRecord) }}"
        onsubmit="return confirm('Proses resep ini? Stok obat akan otomatis dikurangi.')">
        @csrf
        <button class="w-full bg-purple-500 text-white py-3 rounded-xl hover:bg-purple-600 font-semibold">
            Proses Resep & Buat Transaksi
        </button>
    </form>
    @else
    <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
        <p class="text-green-700 font-medium">Resep sudah diproses.</p>
        <a href="{{ route('apoteker.transactions.show', $medicalRecord->transaction) }}" class="text-green-600 text-sm hover:underline">Lihat Transaksi</a>
    </div>
    @endif

    <a href="{{ route('apoteker.prescriptions.index') }}" class="inline-block text-purple-600 hover:underline text-sm">&larr; Kembali</a>
</div>
@endsection
