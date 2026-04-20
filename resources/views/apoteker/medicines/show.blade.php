@extends('layouts.apoteker')
@section('title', 'Detail Obat')
@section('header', 'Detail Obat')

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="font-bold text-lg mb-4">{{ $medicine->name }}</h2>
        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Kategori</dt><dd>{{ $medicine->category }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Satuan</dt><dd>{{ ucfirst($medicine->unit) }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Harga</dt><dd class="font-medium">Rp {{ number_format($medicine->price, 0, ',', '.') }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Stok</dt>
                <dd><span class="px-2 py-1 rounded-full text-xs {{ $medicine->stock < 10 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">{{ $medicine->stock }}</span></dd>
            </div>
            @if($medicine->description)
            <div><dt class="text-gray-500 mb-1">Deskripsi</dt><dd class="bg-gray-50 p-3 rounded-lg">{{ $medicine->description }}</dd></div>
            @endif
        </dl>
        <div class="mt-4 flex gap-3">
            <a href="{{ route('apoteker.medicines.edit', $medicine) }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-purple-600">Edit</a>
            <a href="{{ route('apoteker.medicines.index') }}" class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50">Kembali</a>
        </div>
    </div>
</div>
@endsection
