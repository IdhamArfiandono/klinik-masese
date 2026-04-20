@extends('layouts.public')
@section('title', 'Dokter Kami')

@section('content')
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Dokter Kami</h2>
            <p class="text-gray-500 mt-2">Tenaga medis profesional siap melayani Anda</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($doctors as $doctor)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $doctor->user->name }}</h3>
                        <p class="text-green-600 text-sm font-medium">{{ $doctor->specialization }}</p>
                    </div>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        {{ $doctor->education ?? 'Tidak tersedia' }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $doctor->experience_years }} tahun pengalaman
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400">Biaya Konsultasi</p>
                        <p class="font-bold text-green-600">Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}</p>
                    </div>
                    @auth
                        @if(auth()->user()->isPasien())
                        <a href="{{ route('pasien.appointments.create') }}" class="bg-green-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-600 transition">
                            Buat Janji
                        </a>
                        @endif
                    @else
                    <a href="{{ route('login') }}" class="bg-green-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-600 transition">
                        Buat Janji
                    </a>
                    @endauth
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <p>Belum ada dokter aktif.</p>
            </div>
            @endforelse
        </div>
        <div class="mt-8">
            {{ $doctors->links() }}
        </div>
    </div>
</section>
@endsection
