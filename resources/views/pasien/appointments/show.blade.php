@extends('layouts.pasien')
@section('title', 'Detail Appointment')
@section('header', 'Detail Appointment')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-gray-800">Informasi Appointment</h2>
            @php
                $colors = ['pending' => 'yellow', 'confirmed' => 'blue', 'completed' => 'green', 'cancelled' => 'red'];
                $c = $colors[$appointment->status] ?? 'gray';
            @endphp
            <span class="px-3 py-1 rounded-full text-sm font-medium bg-{{ $c }}-100 text-{{ $c }}-700">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>
        <dl class="space-y-3 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Dokter</dt><dd class="font-medium">{{ $appointment->doctor->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Spesialisasi</dt><dd>{{ $appointment->doctor->specialization }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Tanggal</dt><dd>{{ $appointment->appointment_date->translatedFormat('l, d F Y') }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Jam</dt><dd>{{ $appointment->appointment_time }}</dd></div>
            <div><dt class="text-gray-500 mb-1">Keluhan</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $appointment->complaint }}</dd></div>
        </dl>

        @if(in_array($appointment->status, ['pending', 'confirmed']))
        <div class="mt-4 pt-4 border-t">
            <form method="POST" action="{{ route('pasien.appointments.cancel', $appointment) }}"
                onsubmit="return confirm('Batalkan appointment ini?')">
                @csrf @method('PATCH')
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 text-sm">Batalkan Appointment</button>
            </form>
        </div>
        @endif
    </div>

    @if($appointment->medicalRecord)
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold text-gray-800 mb-4">Rekam Medis</h2>
        <dl class="space-y-3 text-sm">
            <div><dt class="text-gray-500 mb-1">Diagnosis</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $appointment->medicalRecord->diagnosis }}</dd></div>
            @if($appointment->medicalRecord->notes)
            <div><dt class="text-gray-500 mb-1">Catatan Dokter</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $appointment->medicalRecord->notes }}</dd></div>
            @endif
        </dl>

        @if($appointment->medicalRecord->prescriptions->isNotEmpty())
        <div class="mt-4">
            <h3 class="font-medium text-gray-700 mb-3">Resep Obat</h3>
            <div class="space-y-2">
                @foreach($appointment->medicalRecord->prescriptions as $presc)
                <div class="flex items-center justify-between bg-green-50 rounded-lg p-3 text-sm">
                    <div>
                        <p class="font-medium text-gray-800">{{ $presc->medicine->name }}</p>
                        <p class="text-gray-500">{{ $presc->dosage }}</p>
                    </div>
                    <span class="text-gray-600">{{ $presc->quantity }} {{ $presc->medicine->unit }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    @endif

    <a href="{{ route('pasien.appointments.index') }}" class="inline-block text-green-600 hover:underline text-sm">
        &larr; Kembali ke daftar appointment
    </a>
</div>
@endsection
