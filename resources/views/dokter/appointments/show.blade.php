@extends('layouts.dokter')
@section('title', 'Detail Appointment')
@section('header', 'Detail Appointment')

@section('content')
<div class="max-w-2xl space-y-5">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold text-gray-800 mb-4">Informasi Pasien</h2>
        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Nama</dt><dd class="font-medium">{{ $appointment->patient->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Tanggal</dt><dd>{{ $appointment->appointment_date->translatedFormat('l, d F Y') }} | {{ $appointment->appointment_time }}</dd></div>
            <div><dt class="text-gray-500 mb-1">Keluhan</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $appointment->complaint }}</dd></div>
        </dl>
        @if($appointment->status === 'confirmed')
        <div class="mt-4 pt-4 border-t flex gap-3">
            <a href="{{ route('dokter.medical-records.create', ['appointment' => $appointment->id]) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600">
                Input Rekam Medis
            </a>
            <form method="POST" action="{{ route('dokter.appointments.confirm', $appointment) }}">
                @csrf @method('PATCH')
            </form>
        </div>
        @elseif($appointment->status === 'pending')
        <div class="mt-4 pt-4 border-t">
            <form method="POST" action="{{ route('dokter.appointments.confirm', $appointment) }}">
                @csrf @method('PATCH')
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">Konfirmasi Appointment</button>
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
            <div><dt class="text-gray-500 mb-1">Catatan</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $appointment->medicalRecord->notes }}</dd></div>
            @endif
        </dl>
        @if($appointment->medicalRecord->prescriptions->isNotEmpty())
        <div class="mt-4">
            <h3 class="font-medium text-gray-700 mb-2">Resep Obat</h3>
            @foreach($appointment->medicalRecord->prescriptions as $presc)
            <div class="flex justify-between items-center bg-blue-50 rounded-lg p-3 mb-2 text-sm">
                <div>
                    <p class="font-medium">{{ $presc->medicine->name }}</p>
                    <p class="text-gray-500">{{ $presc->dosage }}</p>
                </div>
                <span>{{ $presc->quantity }} {{ $presc->medicine->unit }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endif

    <a href="{{ route('dokter.appointments.index') }}" class="inline-block text-blue-600 hover:underline text-sm">&larr; Kembali</a>
</div>
@endsection
