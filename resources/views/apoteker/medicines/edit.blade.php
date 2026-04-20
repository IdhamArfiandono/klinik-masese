@extends('layouts.apoteker')
@section('title', 'Edit Obat')
@section('header', 'Edit Obat')

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('apoteker.medicines.update', $medicine) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Obat</label>
                    <input type="text" name="name" value="{{ old('name', $medicine->name) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $medicine->category) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                    <select name="unit" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400">
                        @foreach(['tablet','kapsul','botol','tube','ampul','sachet'] as $u)
                        <option value="{{ $u }}" {{ old('unit', $medicine->unit) === $u ? 'selected' : '' }}>{{ ucfirst($u) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $medicine->price) }}" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $medicine->stock) }}" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400">{{ old('description', $medicine->description) }}</textarea>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 font-medium">Simpan Perubahan</button>
                <a href="{{ route('apoteker.medicines.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
