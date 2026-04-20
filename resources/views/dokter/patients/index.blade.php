@extends('layouts.dokter')
@section('title', 'Riwayat Pasien')
@section('header', 'Riwayat Pasien')

@section('content')
<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 border-b">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm flex-1 focus:ring-2 focus:ring-blue-400">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">Cari</button>
        </form>
    </div>
    @forelse($patients as $p)
    <div class="p-4 border-b hover:bg-gray-50 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <p class="font-medium">{{ $p->user->name }}</p>
                <p class="text-sm text-gray-500">{{ $p->user->email }}</p>
            </div>
        </div>
        <a href="{{ route('dokter.patients.show', $p) }}" class="text-blue-600 text-sm hover:underline">Lihat Rekam Medis</a>
    </div>
    @empty
    <div class="p-8 text-center text-gray-400">Tidak ada pasien ditemukan.</div>
    @endforelse
    <div class="p-4">{{ $patients->withQueryString()->links() }}</div>
</div>
@endsection
