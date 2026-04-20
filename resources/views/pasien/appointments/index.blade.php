@extends('layouts.pasien')
@section('title', 'Riwayat Appointment')
@section('header', 'Riwayat Appointment')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b flex items-center justify-between">
        <h2 class="font-semibold text-gray-700">Semua Appointment</h2>
        <a href="{{ route('pasien.appointments.create') }}" class="bg-green-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-600">
            + Buat Janji
        </a>
    </div>
    @forelse($appointments as $apt)
    <div class="p-4 border-b hover:bg-gray-50 transition">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800">{{ $apt->doctor->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $apt->doctor->specialization }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $apt->appointment_date->translatedFormat('d F Y') }} | {{ $apt->appointment_time }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @php
                    $colors = ['pending' => 'yellow', 'confirmed' => 'blue', 'completed' => 'green', 'cancelled' => 'red'];
                    $c = $colors[$apt->status] ?? 'gray';
                @endphp
                <span class="px-2 py-1 rounded-full text-xs font-medium bg-{{ $c }}-100 text-{{ $c }}-700">
                    {{ ucfirst($apt->status) }}
                </span>
                <a href="{{ route('pasien.appointments.show', $apt) }}" class="text-green-600 text-sm hover:underline">Detail</a>
            </div>
        </div>
    </div>
    @empty
    <div class="p-12 text-center text-gray-400">
        <p>Belum ada appointment.</p>
    </div>
    @endforelse
    <div class="p-4">
        {{ $appointments->links() }}
    </div>
</div>
@endsection
