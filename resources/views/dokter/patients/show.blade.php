@extends('layouts.dokter')
@section('title', 'Rekam Medis Pasien')
@section('header', 'Rekam Medis Pasien')

@section('content')
<div class="max-w-3xl space-y-5">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold mb-3">{{ $patient->user->name }}</h2>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><span class="text-gray-500">Email:</span> {{ $patient->user->email }}</div>
            <div><span class="text-gray-500">Telepon:</span> {{ $patient->user->phone ?? '-' }}</div>
            <div><span class="text-gray-500">Tgl Lahir:</span> {{ optional($patient->birth_date)->translatedFormat('d F Y') ?? '-' }}</div>
            <div><span class="text-gray-500">Golongan Darah:</span> {{ $patient->blood_type ?? '-' }}</div>
            @if($patient->allergies)
            <div class="col-span-2"><span class="text-gray-500">Alergi:</span> <span class="text-red-600">{{ $patient->allergies }}</span></div>
            @endif
        </div>
    </div>

    @forelse($records as $record)
    <div class="bg-white rounded-xl shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="font-medium text-gray-700">{{ $record->created_at->translatedFormat('d F Y') }}</p>
            <p class="text-sm text-gray-500">{{ $record->appointment->appointment_time }}</p>
        </div>
        <p class="text-sm font-medium text-gray-800 mb-1">Diagnosis:</p>
        <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg mb-3">{{ $record->diagnosis }}</p>
        @if($record->prescriptions->isNotEmpty())
        <p class="text-sm font-medium text-gray-700 mb-2">Resep:</p>
        @foreach($record->prescriptions as $p)
        <div class="flex justify-between text-sm bg-blue-50 rounded-lg p-2 mb-1">
            <span>{{ $p->medicine->name }} - {{ $p->dosage }}</span>
            <span class="text-gray-600">{{ $p->quantity }} {{ $p->medicine->unit }}</span>
        </div>
        @endforeach
        @endif
    </div>
    @empty
    <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-400">Belum ada rekam medis.</div>
    @endforelse

    <a href="{{ route('dokter.patients.index') }}" class="inline-block text-blue-600 hover:underline text-sm">&larr; Kembali</a>
</div>
@endsection
