@extends('layouts.admin')
@section('title', 'Edit Dokter')
@section('header', 'Edit Dokter')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('admin.doctors.update', $doctor) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $doctor->user->name) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $doctor->user->email) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $doctor->user->phone) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Spesialisasi</label>
                    <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pengalaman (tahun)</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Biaya Konsultasi (Rp)</label>
                    <input type="number" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan</label>
                    <input type="text" name="education" value="{{ old('education', $doctor->education) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Praktek</label>
                @php $schedule = $doctor->schedule ?? []; $days = ['senin','selasa','rabu','kamis','jumat','sabtu']; @endphp
                <div class="space-y-2">
                    @foreach($days as $day)
                    <div class="flex items-center gap-3">
                        <label class="w-20 text-sm capitalize text-gray-600">{{ $day }}</label>
                        <input type="text" name="schedule[{{ $day }}]"
                            value="{{ old("schedule.{$day}", isset($schedule[$day]) ? implode(',', $schedule[$day]) : '') }}"
                            class="flex-1 border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-400">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 font-medium">Simpan</button>
                <a href="{{ route('admin.doctors.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
