@extends('layouts.dokter')
@section('title', 'Jadwal Appointment')
@section('header', 'Jadwal Appointment')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b flex flex-wrap gap-3">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="date" name="date" value="{{ request('date') }}"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400">
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400">
                <option value="">Semua Status</option>
                @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">Filter</button>
            <a href="{{ route('dokter.appointments.index') }}" class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50">Reset</a>
        </form>
    </div>

    @forelse($appointments as $apt)
    <div class="p-4 border-b hover:bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="text-center">
                    <p class="font-bold text-blue-700 text-sm">{{ $apt->appointment_date->translatedFormat('d M') }}</p>
                    <p class="text-gray-500 text-xs">{{ $apt->appointment_time }}</p>
                </div>
                <div>
                    <p class="font-medium text-gray-800">{{ $apt->patient->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ Str::limit($apt->complaint, 80) }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                @php $colors = ['pending' => 'yellow', 'confirmed' => 'blue', 'completed' => 'green', 'cancelled' => 'red']; $c = $colors[$apt->status] ?? 'gray'; @endphp
                <span class="px-2 py-1 text-xs rounded-full bg-{{ $c }}-100 text-{{ $c }}-700">{{ ucfirst($apt->status) }}</span>
                @if($apt->status === 'pending')
                <form method="POST" action="{{ route('dokter.appointments.confirm', $apt) }}">
                    @csrf @method('PATCH')
                    <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-blue-600">Konfirmasi</button>
                </form>
                @elseif($apt->status === 'confirmed')
                <a href="{{ route('dokter.medical-records.create', ['appointment' => $apt->id]) }}" class="bg-green-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-green-600">
                    Input Rekam Medis
                </a>
                @endif
                <a href="{{ route('dokter.appointments.show', $apt) }}" class="text-blue-600 text-xs hover:underline">Detail</a>
            </div>
        </div>
    </div>
    @empty
    <div class="p-8 text-center text-gray-400">Tidak ada appointment ditemukan.</div>
    @endforelse
    <div class="p-4">{{ $appointments->withQueryString()->links() }}</div>
</div>
@endsection
