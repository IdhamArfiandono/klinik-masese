@extends('layouts.apoteker')
@section('title', 'Resep Masuk')
@section('header', 'Resep Masuk')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-4 border-b">
        <h2 class="font-semibold text-gray-700">Resep Belum Diproses</h2>
    </div>
    @forelse($resepBelumDiproses as $rec)
    <div class="p-4 border-b hover:bg-gray-50">
        <div class="flex items-center justify-between">
            <div>
                <p class="font-medium text-gray-800">{{ $rec->patient->user->name }}</p>
                <p class="text-sm text-gray-500">Dokter: {{ $rec->doctor->user->name }}</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $rec->created_at->translatedFormat('d F Y H:i') }}</p>
                <div class="flex gap-1 mt-2 flex-wrap">
                    @foreach($rec->prescriptions->take(3) as $p)
                    <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full">{{ $p->medicine->name }}</span>
                    @endforeach
                    @if($rec->prescriptions->count() > 3)
                    <span class="text-xs text-gray-400">+{{ $rec->prescriptions->count() - 3 }} lagi</span>
                    @endif
                </div>
            </div>
            <a href="{{ route('apoteker.prescriptions.show', $rec) }}" class="bg-purple-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-purple-600">
                Detail & Proses
            </a>
        </div>
    </div>
    @empty
    <div class="p-8 text-center text-gray-400">Tidak ada resep yang perlu diproses.</div>
    @endforelse
    <div class="p-4">{{ $resepBelumDiproses->links() }}</div>
</div>
@endsection
