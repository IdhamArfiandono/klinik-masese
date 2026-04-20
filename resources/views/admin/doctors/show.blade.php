@extends('layouts.admin')
@section('title', 'Detail Dokter')
@section('header', 'Detail Dokter')

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-semibold mb-4">{{ $doctor->user->name }}</h2>
        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Email</dt><dd>{{ $doctor->user->email }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Spesialisasi</dt><dd>{{ $doctor->specialization }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Pengalaman</dt><dd>{{ $doctor->experience_years }} tahun</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Biaya Konsultasi</dt><dd>Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Status</dt><dd>{{ $doctor->is_active ? 'Aktif' : 'Nonaktif' }}</dd></div>
        </dl>
        <div class="mt-4">
            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600">Edit</a>
            <a href="{{ route('admin.doctors.index') }}" class="ml-2 text-gray-600 text-sm hover:underline">Kembali</a>
        </div>
    </div>
</div>
@endsection
