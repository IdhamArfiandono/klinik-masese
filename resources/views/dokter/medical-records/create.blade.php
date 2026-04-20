@extends('layouts.dokter')
@section('title', 'Input Rekam Medis')
@section('header', 'Input Rekam Medis')

@section('content')
<div class="max-w-3xl">
    <div class="bg-blue-50 rounded-xl p-4 mb-5 text-sm">
        <p class="font-medium text-blue-800">Pasien: {{ $appointment->patient->user->name }}</p>
        <p class="text-blue-600">{{ $appointment->appointment_date->translatedFormat('l, d F Y') }} | {{ $appointment->appointment_time }}</p>
        <p class="text-blue-600 mt-1">Keluhan: {{ $appointment->complaint }}</p>
    </div>

    <form method="POST" action="{{ route('dokter.medical-records.store') }}"
        x-data="prescriptionForm()">
        @csrf
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

        <div class="bg-white rounded-xl shadow-sm p-6 mb-5">
            <h2 class="font-semibold text-gray-700 mb-4">Rekam Medis</h2>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Diagnosis <span class="text-red-500">*</span></label>
                <textarea name="diagnosis" rows="3" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 @error('diagnosis') border-red-400 @enderror">{{ old('diagnosis') }}</textarea>
                @error('diagnosis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                <textarea name="notes" rows="2"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">{{ old('notes') }}</textarea>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 mb-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-gray-700">Resep Obat</h2>
                <button type="button" @click="addMedicine()" class="bg-blue-500 text-white text-sm px-3 py-1 rounded-lg hover:bg-blue-600">+ Tambah Obat</button>
            </div>

            <template x-for="(item, idx) in items" :key="idx">
                <div class="grid grid-cols-12 gap-3 mb-3 p-3 bg-gray-50 rounded-lg">
                    <div class="col-span-5">
                        <label class="text-xs text-gray-500 mb-1 block">Nama Obat</label>
                        <select :name="`medicines[${idx}][medicine_id]`" x-model="item.medicine_id" required
                            class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:ring-2 focus:ring-blue-400">
                            <option value="">-- Pilih --</option>
                            @foreach($medicines as $med)
                            <option value="{{ $med->id }}">{{ $med->name }} ({{ $med->stock }} {{ $med->unit }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="text-xs text-gray-500 mb-1 block">Jumlah</label>
                        <input type="number" :name="`medicines[${idx}][quantity]`" x-model="item.quantity" min="1" required
                            class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div class="col-span-4">
                        <label class="text-xs text-gray-500 mb-1 block">Dosis</label>
                        <input type="text" :name="`medicines[${idx}][dosage]`" x-model="item.dosage" placeholder="3x1 tablet" required
                            class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div class="col-span-1 flex items-end pb-1">
                        <button type="button" @click="items.splice(idx, 1)" class="text-red-400 hover:text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            </template>

            <p x-show="items.length === 0" class="text-sm text-gray-400 text-center py-4">Belum ada obat ditambahkan.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" onclick="return confirm('Simpan rekam medis? Appointment akan ditandai selesai.')"
                class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 font-medium">
                Simpan & Selesaikan
            </button>
            <a href="{{ route('dokter.appointments.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-50">Batal</a>
        </div>
    </form>
</div>

<script>
function prescriptionForm() {
    return {
        items: [],
        addMedicine() {
            this.items.push({ medicine_id: '', quantity: 1, dosage: '' });
        }
    }
}
</script>
@endsection
