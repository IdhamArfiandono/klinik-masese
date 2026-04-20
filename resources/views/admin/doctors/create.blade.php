@extends('layouts.admin')
@section('title', 'Tambah Dokter')
@section('header', 'Tambah Dokter Baru')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('admin.doctors.store') }}" x-data="{ days: ['senin','selasa','rabu','kamis','jumat','sabtu'], schedule: {} }">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 @error('name') border-red-400 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 @error('email') border-red-400 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Spesialisasi</label>
                    <input type="text" name="specialization" value="{{ old('specialization') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pengalaman (tahun)</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', 0) }}" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Biaya Konsultasi (Rp)</label>
                    <input type="number" name="consultation_fee" value="{{ old('consultation_fee', 0) }}" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan</label>
                    <input type="text" name="education" value="{{ old('education') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
            </div>

            {{-- Jadwal --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Praktek (input jam dipisah koma, cth: 08:00,09:00,10:00)</label>
                <div class="space-y-2">
                    <template x-for="day in days" :key="day">
                        <div class="flex items-center gap-3">
                            <label class="w-20 text-sm capitalize text-gray-600" x-text="day"></label>
                            <input type="text" :name="`schedule[${day}]`" :placeholder="day === 'sabtu' ? 'kosong = tidak praktek' : '08:00,09:00,10:00'"
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-400">
                        </div>
                    </template>
                </div>
                <p class="text-xs text-gray-400 mt-1">Kosongkan hari yang tidak praktek.</p>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 font-medium">Simpan</button>
                <a href="{{ route('admin.doctors.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
