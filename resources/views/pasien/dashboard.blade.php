@extends('layouts.pasien')
@section('title', 'Dashboard Pasien')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Appointment Mendatang --}}
    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Appointment Mendatang</h2>
        @forelse($appointmentMendatang as $apt)
        <div class="bg-white rounded-xl shadow-sm p-5 flex items-center justify-between mb-3">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">{{ $apt->doctor->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $apt->doctor->specialization }}</p>
                    <p class="text-sm text-gray-500">{{ $apt->appointment_date->translatedFormat('l, d F Y') }} pukul {{ $apt->appointment_time }}</p>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $apt->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ ucfirst($apt->status) }}
            </span>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-sm p-6 text-center text-gray-400">
            <p>Tidak ada appointment mendatang.</p>
            <a href="{{ route('pasien.appointments.create') }}" class="inline-block mt-3 bg-green-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-600">Buat Janji Sekarang</a>
        </div>
        @endforelse
    </div>

    {{-- Riwayat Kunjungan --}}
    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Riwayat Kunjungan Terakhir</h2>
        @forelse($riwayatKunjungan as $apt)
        <div class="bg-white rounded-xl shadow-sm p-5 mb-3">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-semibold text-gray-800">{{ $apt->doctor->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $apt->appointment_date->translatedFormat('d F Y') }}</p>
                    @if($apt->medicalRecord)
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($apt->medicalRecord->diagnosis, 80) }}</p>
                    @endif
                </div>
                <a href="{{ route('pasien.appointments.show', $apt) }}" class="text-green-600 text-sm hover:underline">Detail</a>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-sm p-6 text-center text-gray-400">Belum ada riwayat kunjungan.</div>
        @endforelse
    </div>

    {{-- Riwayat Pembelian --}}
    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Riwayat Pembelian Obat</h2>
        @forelse($riwayatPembelian as $trx)
        <div class="bg-white rounded-xl shadow-sm p-5 mb-3 flex items-center justify-between">
            <div>
                <p class="font-medium text-gray-800">Transaksi #{{ $trx->id }}</p>
                <p class="text-sm text-gray-500">{{ $trx->created_at->translatedFormat('d F Y') }}</p>
                <p class="text-sm text-gray-600">{{ $trx->items->count() }} item obat</p>
            </div>
            <p class="font-bold text-green-700">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</p>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-sm p-6 text-center text-gray-400">Belum ada riwayat pembelian.</div>
        @endforelse
    </div>

</div>
@endsection
