@extends('layouts.public')
@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-br from-green-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block bg-green-100 text-green-700 text-sm font-medium px-3 py-1 rounded-full mb-4">Klinik & Apotek Terpercaya</span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    Kesehatan Anda<br>
                    <span class="text-green-500">Adalah Prioritas Kami</span>
                </h1>
                <p class="text-gray-500 text-lg mb-8">Dapatkan layanan kesehatan terbaik dari dokter berpengalaman dan apotek lengkap di satu tempat.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="bg-green-500 text-white px-8 py-3 rounded-xl font-semibold hover:bg-green-600 transition text-center">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('public.doctors') }}" class="border border-green-500 text-green-600 px-8 py-3 rounded-xl font-semibold hover:bg-green-50 transition text-center">
                        Lihat Dokter
                    </a>
                </div>
            </div>
            <div class="hidden md:flex justify-center">
                <div class="relative">
                    <div class="w-80 h-80 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-48 h-48 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-lg p-4">
                        <p class="text-2xl font-bold text-green-600">10+</p>
                        <p class="text-xs text-gray-500">Dokter Aktif</p>
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-lg p-4">
                        <p class="text-2xl font-bold text-green-600">500+</p>
                        <p class="text-xs text-gray-500">Pasien Puas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Layanan --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Layanan Kami</h2>
            <p class="text-gray-500 mt-2">Berbagai layanan kesehatan lengkap untuk Anda dan keluarga</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'title' => 'Konsultasi Umum', 'desc' => 'Pemeriksaan dan konsultasi kesehatan umum', 'color' => 'green'],
                ['icon' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Konsultasi Gigi', 'desc' => 'Perawatan gigi dan mulut komprehensif', 'color' => 'blue'],
                ['icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z', 'title' => 'Apotek', 'desc' => 'Obat lengkap dan harga terjangkau', 'color' => 'purple'],
                ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01', 'title' => 'Pemeriksaan Lab', 'desc' => 'Pemeriksaan laboratorium lengkap', 'color' => 'orange'],
            ] as $layanan)
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-{{ $layanan['color'] }}-100 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-{{ $layanan['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $layanan['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">{{ $layanan['title'] }}</h3>
                <p class="text-gray-500 text-sm">{{ $layanan['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Dokter Tersedia --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Dokter Kami</h2>
            <p class="text-gray-500 mt-2">Ditangani oleh dokter berpengalaman dan bersertifikat</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($doctors->take(3) as $doctor)
            <div class="bg-white rounded-2xl shadow-sm p-6 text-center hover:shadow-md transition">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-lg">{{ $doctor->user->name }}</h3>
                <p class="text-green-600 text-sm font-medium mt-1">{{ $doctor->specialization }}</p>
                <p class="text-gray-400 text-xs mt-1">{{ $doctor->experience_years }} tahun pengalaman</p>
                <p class="text-gray-700 text-sm font-medium mt-3">Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('public.doctors') }}" class="inline-block border border-green-500 text-green-600 px-6 py-2 rounded-xl hover:bg-green-50 transition font-medium">
                Lihat Semua Dokter
            </a>
        </div>
    </div>
</section>

{{-- Jam Buka & Lokasi --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-green-50 rounded-2xl p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Jam Operasional</h3>
                <div class="space-y-3">
                    @foreach(['Senin - Jumat' => '08.00 - 17.00', 'Sabtu' => '08.00 - 13.00', 'Minggu' => 'Tutup'] as $hari => $jam)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">{{ $hari }}</span>
                        <span class="font-medium {{ $jam === 'Tutup' ? 'text-red-500' : 'text-green-700' }}">{{ $jam }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-green-50 rounded-2xl p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Lokasi Kami</h3>
                <div class="space-y-3 text-gray-600">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Jl. Sehat Raya No. 10, Jakarta Selatan, DKI Jakarta 12345</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>(021) 555-0100</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
