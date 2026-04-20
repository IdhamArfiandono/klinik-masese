@extends('layouts.apoteker')
@section('title', 'Dashboard Apoteker')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Resep Masuk</p>
                <p class="text-3xl font-bold text-gray-800">{{ $resepMasuk->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Stok Hampir Habis</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stokHampirHabis->count() }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Resep Masuk --}}
<div class="bg-white rounded-xl shadow-sm mb-6">
    <div class="p-4 border-b flex items-center justify-between">
        <h2 class="font-semibold text-gray-700">Resep Perlu Diproses</h2>
        <a href="{{ route('apoteker.prescriptions.index') }}" class="text-purple-600 text-sm hover:underline">Lihat Semua</a>
    </div>
    @forelse($resepMasuk->take(5) as $rec)
    <div class="p-4 border-b hover:bg-gray-50 flex items-center justify-between">
        <div>
            <p class="font-medium text-gray-800">{{ $rec->patient->user->name }}</p>
            <p class="text-sm text-gray-500">{{ $rec->prescriptions->count() }} item obat</p>
            <p class="text-xs text-gray-400">{{ $rec->created_at->diffForHumans() }}</p>
        </div>
        <a href="{{ route('apoteker.prescriptions.show', $rec) }}" class="bg-purple-500 text-white text-sm px-3 py-1 rounded-lg hover:bg-purple-600">
            Proses
        </a>
    </div>
    @empty
    <div class="p-6 text-center text-gray-400 text-sm">Tidak ada resep masuk.</div>
    @endforelse
</div>

{{-- Stok Hampir Habis --}}
@if($stokHampirHabis->isNotEmpty())
<div class="bg-red-50 border border-red-200 rounded-xl p-5">
    <h2 class="font-semibold text-red-700 mb-3">Peringatan Stok Hampir Habis</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach($stokHampirHabis as $med)
        <div class="bg-white border border-red-200 rounded-lg p-3 flex items-center justify-between">
            <div>
                <p class="font-medium text-gray-800 text-sm">{{ $med->name }}</p>
                <p class="text-xs text-gray-500">{{ $med->category }}</p>
            </div>
            <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full">{{ $med->stock }} {{ $med->unit }}</span>
        </div>
        @endforeach
    </div>
    <a href="{{ route('apoteker.medicines.index') }}" class="inline-block mt-3 text-red-600 text-sm hover:underline">Kelola Stok &rarr;</a>
</div>
@endif
@endsection
