@extends('layouts.apoteker')
@section('title', 'Kelola Obat')
@section('header', 'Kelola Obat')

@section('content')
@if($stokHampirHabis > 0)
<div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
    <strong>Peringatan:</strong> Ada {{ $stokHampirHabis }} obat dengan stok di bawah 10 unit.
</div>
@endif

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b flex items-center justify-between gap-3 flex-wrap">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari obat..."
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-400">
            <button class="bg-purple-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-purple-600">Cari</button>
        </form>
        <a href="{{ route('apoteker.medicines.create') }}" class="bg-purple-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-purple-600">
            + Tambah Obat
        </a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3 text-gray-600">Nama Obat</th>
                <th class="text-left px-4 py-3 text-gray-600">Kategori</th>
                <th class="text-left px-4 py-3 text-gray-600">Satuan</th>
                <th class="text-right px-4 py-3 text-gray-600">Harga</th>
                <th class="text-center px-4 py-3 text-gray-600">Stok</th>
                <th class="text-center px-4 py-3 text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($medicines as $med)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $med->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $med->category }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $med->unit }}</td>
                <td class="px-4 py-3 text-right">Rp {{ number_format($med->price, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $med->stock < 10 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                        {{ $med->stock }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center gap-2" x-data="{ showRestock: false }">
                        <button @click="showRestock = !showRestock" class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded hover:bg-yellow-200">Restock</button>
                        <a href="{{ route('apoteker.medicines.edit', $med) }}" class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200">Edit</a>
                        <form method="POST" action="{{ route('apoteker.medicines.destroy', $med) }}" onsubmit="return confirm('Hapus obat ini?')">
                            @csrf @method('DELETE')
                            <button class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded hover:bg-red-200">Hapus</button>
                        </form>
                        <div x-show="showRestock" @click.away="showRestock = false" class="absolute z-10 bg-white border rounded-lg shadow-lg p-3 mt-1">
                            <form method="POST" action="{{ route('apoteker.medicines.restock', $med) }}" class="flex gap-2">
                                @csrf @method('PATCH')
                                <input type="number" name="jumlah" min="1" placeholder="Jumlah" class="border rounded px-2 py-1 text-xs w-20">
                                <button class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">Tambah</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">Tidak ada obat.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $medicines->withQueryString()->links() }}</div>
</div>
@endsection
