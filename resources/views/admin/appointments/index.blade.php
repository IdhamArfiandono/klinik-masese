@extends('layouts.admin')
@section('title', 'Kelola Appointment')
@section('header', 'Kelola Appointment')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b flex flex-wrap gap-3">
        <form method="GET" class="flex flex-wrap gap-2">
            <select name="doctor_id" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Dokter</option>
                @foreach($doctors as $d)
                <option value="{{ $d->id }}" {{ request('doctor_id') == $d->id ? 'selected' : '' }}>{{ $d->user->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date') }}" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Status</option>
                @foreach(['pending','confirmed','completed','cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
            <a href="{{ route('admin.appointments.index') }}" class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm">Reset</a>
        </form>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3 text-gray-600">Pasien</th>
                <th class="text-left px-4 py-3 text-gray-600">Dokter</th>
                <th class="text-left px-4 py-3 text-gray-600">Tanggal & Jam</th>
                <th class="text-center px-4 py-3 text-gray-600">Status</th>
                <th class="text-center px-4 py-3 text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $apt)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $apt->patient->user->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $apt->doctor->user->name }}</td>
                <td class="px-4 py-3 text-gray-600 text-xs">{{ $apt->appointment_date->translatedFormat('d M Y') }}<br>{{ $apt->appointment_time }}</td>
                <td class="px-4 py-3 text-center">
                    @php $colors = ['pending'=>'yellow','confirmed'=>'blue','completed'=>'green','cancelled'=>'red']; $c=$colors[$apt->status]??'gray'; @endphp
                    <span class="px-2 py-1 rounded-full text-xs bg-{{ $c }}-100 text-{{ $c }}-700">{{ ucfirst($apt->status) }}</span>
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.appointments.show', $apt) }}" class="text-green-600 text-xs hover:underline">Detail</a>
                        <form method="POST" action="{{ route('admin.appointments.destroy', $apt) }}" onsubmit="return confirm('Hapus appointment?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-xs hover:underline">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Tidak ada appointment.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $appointments->withQueryString()->links() }}</div>
</div>
@endsection
