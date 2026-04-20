@extends('layouts.pasien')
@section('title', 'Profil Saya')
@section('header', 'Profil Saya')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('pasien.profile.update') }}">
            @csrf @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 @error('name') border-red-400 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', optional($patient->birth_date)->format('Y-m-d')) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="gender" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('gender', $patient->gender) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $patient->gender) === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                    <select name="blood_type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">
                        <option value="">-- Pilih --</option>
                        @foreach(['A', 'B', 'AB', 'O'] as $bt)
                        <option value="{{ $bt }}" {{ old('blood_type', $patient->blood_type) === $bt ? 'selected' : '' }}>{{ $bt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="address" rows="2"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">{{ old('address', $patient->address) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alergi</label>
                <textarea name="allergies" rows="2" placeholder="Contoh: Penisilin, seafood..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400">{{ old('allergies', $patient->allergies) }}</textarea>
            </div>

            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition font-medium">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
