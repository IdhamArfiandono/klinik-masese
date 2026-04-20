@extends('layouts.dokter')
@section('title', 'Detail Rekam Medis')
@section('header', 'Detail Rekam Medis')

@section('content')
<div class="max-w-2xl space-y-5">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold mb-4">Rekam Medis</h2>
        <dl class="space-y-3 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Pasien</dt><dd class="font-medium">{{ $medicalRecord->patient->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Tanggal</dt><dd>{{ $medicalRecord->created_at->translatedFormat('d F Y H:i') }}</dd></div>
            <div><dt class="text-gray-500 mb-1">Diagnosis</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $medicalRecord->diagnosis }}</dd></div>
            @if($medicalRecord->notes)
            <div><dt class="text-gray-500 mb-1">Catatan</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $medicalRecord->notes }}</dd></div>
            @endif
        </dl>
        @if($medicalRecord->prescriptions->isNotEmpty())
        <div class="mt-4">
            <h3 class="font-medium text-gray-700 mb-2">Resep Obat</h3>
            @foreach($medicalRecord->prescriptions as $p)
            <div class="flex justify-between items-center bg-blue-50 rounded-lg p-3 mb-2 text-sm">
                <div><p class="font-medium">{{ $p->medicine->name }}</p><p class="text-gray-500">{{ $p->dosage }}</p></div>
                <span>{{ $p->quantity }} {{ $p->medicine->unit }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <a href="{{ route('dokter.appointments.index') }}" class="inline-block text-blue-600 hover:underline text-sm">&larr; Kembali</a>
</div>
@endsection
