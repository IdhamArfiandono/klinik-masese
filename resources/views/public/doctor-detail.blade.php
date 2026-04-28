@extends('layouts.public')
@section('title', $doctor->user->name)

@section('content')
<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-green-600">Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('public.doctors') }}" class="hover:text-green-600">Dokter</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-700">{{ $doctor->user->name }}</span>
        </nav>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
            <div class="flex items-center gap-6 mb-6">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $doctor->user->name }}</h1>
                    <p class="text-green-600 font-medium mt-1">{{ $doctor->specialization }}</p>
                    <span class="inline-block mt-2 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Aktif Berpraktik</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 border-t border-gray-100">
                <div class="text-center p-4 bg-gray-50 rounded-xl">
                    <p class="text-2xl font-bold text-green-600">{{ $doctor->experience_years }}</p>
                    <p class="text-xs text-gray-500 mt-1">Tahun Pengalaman</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-xl sm:col-span-2">
                    <p class="text-lg font-bold text-green-600">Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 mt-1">Biaya Konsultasi</p>
                </div>
            </div>
        </div>

        <!-- Info -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <h2 class="font-semibold text-gray-800 mb-4">Informasi Dokter</h2>
            <div class="space-y-3 text-sm">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <div>
                        <p class="text-xs text-gray-400 mb-0.5">Pendidikan</p>
                        <p class="text-gray-700 font-medium">{{ $doctor->education ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex items-center gap-2 mb-5">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h2 class="font-semibold text-gray-800">Jadwal Praktik</h2>
            </div>

            @php
                $dayNames = [
                    'senin'   => 'Senin',
                    'selasa'  => 'Selasa',
                    'rabu'    => 'Rabu',
                    'kamis'   => 'Kamis',
                    'jumat'   => 'Jumat',
                    'sabtu'   => 'Sabtu',
                    'minggu'  => 'Minggu',
                ];
                $hasSchedule = $doctor->schedule && count($doctor->schedule);
            @endphp

            @if($hasSchedule)
            <div class="space-y-3">
                @foreach($dayNames as $key => $label)
                    @php $slots = $doctor->schedule[$key] ?? []; @endphp
                    <div class="flex items-start gap-4 py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                        <div class="w-20 flex-shrink-0">
                            <span class="text-sm font-semibold {{ count($slots) ? 'text-gray-800' : 'text-gray-300' }}">{{ $label }}</span>
                        </div>
                        @if(count($slots))
                        <div class="flex flex-wrap gap-2">
                            @foreach($slots as $time)
                            <span class="bg-blue-50 text-blue-700 text-sm font-medium px-3 py-1 rounded-full border border-blue-100">
                                {{ $time }}
                            </span>
                            @endforeach
                        </div>
                        @else
                        <span class="text-sm text-gray-300">Tidak praktik</span>
                        @endif
                    </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 text-sm">Jadwal belum tersedia. Hubungi klinik untuk informasi lebih lanjut.</p>
            @endif
        </div>

        <!-- CTA -->
        <div class="bg-green-50 border border-green-200 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <p class="font-semibold text-gray-800">Ingin berkonsultasi?</p>
                <p class="text-sm text-gray-500 mt-1">Buat janji temu sekarang dan pilih jadwal yang tersedia.</p>
            </div>
            @auth
                @if(auth()->user()->isPasien())
                <a href="{{ route('pasien.appointments.create') }}"
                    class="bg-green-500 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-green-600 transition whitespace-nowrap">
                    Buat Janji Temu
                </a>
                @endif
            @else
            <a href="{{ route('login') }}"
                class="bg-green-500 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-green-600 transition whitespace-nowrap">
                Masuk untuk Buat Janji
            </a>
            @endauth
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('public.doctors') }}" class="text-sm text-gray-400 hover:text-green-600 flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Dokter
            </a>
        </div>

    </div>
</section>
@endsection
