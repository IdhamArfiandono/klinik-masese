@extends('layouts.admin')
@section('title', 'Detail Appointment')
@section('header', 'Detail Appointment')

@section('content')
<div class="max-w-2xl space-y-5">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold">Detail Appointment</h2>
            <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}">
                @csrf @method('PUT')
                <div class="flex gap-2">
                    <select name="status" class="border rounded-lg px-3 py-1.5 text-sm">
                        @foreach(['pending','confirmed','completed','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $appointment->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button class="bg-green-500 text-white text-sm px-3 py-1.5 rounded-lg hover:bg-green-600">Update</button>
                </div>
            </form>
        </div>
        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Pasien</dt><dd class="font-medium">{{ $appointment->patient->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Dokter</dt><dd>{{ $appointment->doctor->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Spesialisasi</dt><dd>{{ $appointment->doctor->specialization }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Tanggal</dt><dd>{{ $appointment->appointment_date->translatedFormat('l, d F Y') }} | {{ $appointment->appointment_time }}</dd></div>
            <div><dt class="text-gray-500 mb-1">Keluhan</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $appointment->complaint }}</dd></div>
        </dl>
    </div>
    @if($appointment->medicalRecord)
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold mb-3">Rekam Medis</h2>
        <p class="text-sm text-gray-600">{{ $appointment->medicalRecord->diagnosis }}</p>
        @if($appointment->medicalRecord->prescriptions->isNotEmpty())
        <div class="mt-3">
            @foreach($appointment->medicalRecord->prescriptions as $p)
            <div class="text-sm bg-green-50 rounded-lg p-2 mb-1 flex justify-between">
                <span>{{ $p->medicine->name }} - {{ $p->dosage }}</span>
                <span>{{ $p->quantity }} {{ $p->medicine->unit }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endif
    <a href="{{ route('admin.appointments.index') }}" class="inline-block text-green-600 hover:underline text-sm">&larr; Kembali</a>
</div>
@endsection
