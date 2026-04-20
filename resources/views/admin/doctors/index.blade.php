@extends('layouts.admin')
@section('title', 'Kelola Dokter')
@section('header', 'Kelola Dokter')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="font-semibold text-gray-700">Daftar Dokter</h2>
        <a href="{{ route('admin.doctors.create') }}" class="bg-green-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-600">+ Tambah Dokter</a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3 text-gray-600">Nama</th>
                <th class="text-left px-4 py-3 text-gray-600">Spesialisasi</th>
                <th class="text-right px-4 py-3 text-gray-600">Biaya</th>
                <th class="text-center px-4 py-3 text-gray-600">Status</th>
                <th class="text-center px-4 py-3 text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($doctors as $d)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $d->user->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $d->specialization }}</td>
                <td class="px-4 py-3 text-right">Rp {{ number_format($d->consultation_fee, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-1 rounded-full text-xs {{ $d->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $d->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.doctors.edit', $d) }}" class="text-blue-600 text-xs hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.doctors.toggle', $d) }}">
                            @csrf @method('PATCH')
                            <button class="text-xs {{ $d->is_active ? 'text-red-500' : 'text-green-600' }} hover:underline">
                                {{ $d->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.doctors.destroy', $d) }}" onsubmit="return confirm('Hapus dokter ini?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">Tidak ada dokter.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $doctors->links() }}</div>
</div>
@endsection
