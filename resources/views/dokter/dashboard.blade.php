@extends('layouts.dokter')
@section('title', 'Dashboard Dokter')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Appointment Hari Ini</p>
                <p class="text-3xl font-bold text-gray-800">{{ $appointmentHariIni->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Pasien Bulan Ini</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalPasienBulanIni }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 border-b">
        <h2 class="font-semibold text-gray-700">Jadwal Hari Ini - {{ now()->translatedFormat('l, d F Y') }}</h2>
    </div>
    @forelse($appointmentHariIni as $apt)
    <div class="p-4 border-b flex items-center justify-between hover:bg-gray-50">
        <div class="flex items-center gap-4">
            <div class="text-center w-14">
                <p class="font-bold text-blue-700">{{ $apt->appointment_time }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-800">{{ $apt->patient->user->name }}</p>
                <p class="text-sm text-gray-500">{{ Str::limit($apt->complaint, 60) }}</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            @php $colors = ['pending' => 'yellow', 'confirmed' => 'blue', 'completed' => 'green']; $c = $colors[$apt->status] ?? 'gray'; @endphp
            <span class="px-2 py-1 text-xs rounded-full bg-{{ $c }}-100 text-{{ $c }}-700">{{ ucfirst($apt->status) }}</span>
            @if($apt->status === 'confirmed')
            <a href="{{ route('dokter.medical-records.create', ['appointment' => $apt->id]) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600">
                Input Rekam Medis
            </a>
            @endif
        </div>
    </div>
    @empty
    <div class="p-8 text-center text-gray-400">Tidak ada appointment hari ini.</div>
    @endforelse
</div>
@endsection
