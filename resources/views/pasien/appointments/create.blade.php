@extends('layouts.pasien')
@section('title', 'Buat Janji')
@section('header', 'Buat Janji Temu')

@section('content')
<div class="max-w-2xl" x-data="appointmentForm()">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('pasien.appointments.store') }}">
            @csrf

            {{-- Pilih Dokter --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Dokter</label>
                <select name="doctor_id" x-model="selectedDoctor" @change="updateSchedule()" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 focus:border-transparent @error('doctor_id') border-red-400 @enderror">
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}"
                        data-schedule="{{ json_encode($doctor->schedule) }}"
                        {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->user->name }} - {{ $doctor->specialization }} (Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }})
                    </option>
                    @endforeach
                </select>
                @error('doctor_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Pilih Tanggal --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Appointment</label>
                <input type="date" name="appointment_date" x-model="selectedDate" @change="updateTimes()"
                    min="{{ now()->format('Y-m-d') }}" value="{{ old('appointment_date') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 @error('appointment_date') border-red-400 @enderror">
                @error('appointment_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Pilih Jam --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Jam Appointment</label>
                <select name="appointment_time" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 @error('appointment_time') border-red-400 @enderror">
                    <option value="">-- Pilih Jam --</option>
                    <template x-for="time in availableTimes" :key="time">
                        <option :value="time" x-text="time" :selected="time === '{{ old('appointment_time') }}'"></option>
                    </template>
                </select>
                <p x-show="selectedDoctor && selectedDate && availableTimes.length === 0" class="text-yellow-600 text-xs mt-1">
                    Dokter tidak praktek pada hari ini atau jadwal tidak tersedia.
                </p>
                @error('appointment_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Keluhan --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Keluhan</label>
                <textarea name="complaint" rows="4" required placeholder="Deskripsikan keluhan Anda..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 @error('complaint') border-red-400 @enderror">{{ old('complaint') }}</textarea>
                @error('complaint') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition font-medium">
                    Buat Janji
                </button>
                <a href="{{ route('pasien.dashboard') }}" class="border border-gray-300 text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function appointmentForm() {
    return {
        selectedDoctor: '{{ old('doctor_id') }}',
        selectedDate: '{{ old('appointment_date') }}',
        availableTimes: [],
        scheduleData: {},
        dayMap: { 0: 'minggu', 1: 'senin', 2: 'selasa', 3: 'rabu', 4: 'kamis', 5: 'jumat', 6: 'sabtu' },

        updateSchedule() {
            const select = document.querySelector('select[name="doctor_id"]');
            const option = select.options[select.selectedIndex];
            if (option && option.dataset.schedule) {
                this.scheduleData = JSON.parse(option.dataset.schedule);
            } else {
                this.scheduleData = {};
            }
            this.updateTimes();
        },

        updateTimes() {
            if (!this.selectedDate || !this.selectedDoctor) {
                this.availableTimes = [];
                return;
            }
            const date = new Date(this.selectedDate);
            const dayName = this.dayMap[date.getDay()];
            this.availableTimes = this.scheduleData[dayName] || [];
        },

        init() {
            if (this.selectedDoctor) this.updateSchedule();
        }
    }
}
</script>
@endsection
