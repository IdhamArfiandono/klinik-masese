@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Pasien</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalPasien }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Appointment Hari Ini</p>
            <p class="text-3xl font-bold text-gray-800">{{ $appointmentHariIni }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Pendapatan Bulan Ini</p>
            <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 border-b flex items-center justify-between">
        <h2 class="font-semibold text-gray-700">Appointment Pending</h2>
        <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}" class="text-green-600 text-sm hover:underline">Lihat Semua</a>
    </div>
    @forelse($appointmentPending as $apt)
    <div class="p-4 border-b hover:bg-gray-50 flex items-center justify-between">
        <div>
            <p class="font-medium text-gray-800">{{ $apt->patient->user->name }}</p>
            <p class="text-sm text-gray-500">{{ $apt->doctor->user->name }} - {{ $apt->doctor->specialization }}</p>
            <p class="text-xs text-gray-400">{{ $apt->appointment_date->translatedFormat('d F Y') }} | {{ $apt->appointment_time }}</p>
        </div>
        <a href="{{ route('admin.appointments.show', $apt) }}" class="text-green-600 text-sm hover:underline">Detail</a>
    </div>
    @empty
    <div class="p-6 text-center text-gray-400 text-sm">Tidak ada appointment pending.</div>
    @endforelse
</div>
@endsection
