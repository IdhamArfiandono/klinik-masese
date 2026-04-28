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
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition" x-data="{ showSchedule: false }">
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
                <div class="space-y-2 text-sm text-gray-600 mb-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        {{ $doctor->education ?? 'Tidak tersedia' }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $doctor->experience_years }} tahun pengalaman
                    </div>
                </div>

                <!-- Schedule toggle -->
                @if($doctor->schedule && count($doctor->schedule))
                <div class="mb-4">
                    <button type="button" @click="showSchedule = !showSchedule"
                        class="flex items-center gap-1.5 text-sm text-blue-600 hover:text-blue-800 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span x-text="showSchedule ? 'Sembunyikan Jadwal' : 'Lihat Jadwal'"></span>
                        <svg class="w-4 h-4 transition-transform" :class="showSchedule ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="showSchedule" x-transition class="mt-3 bg-blue-50 rounded-xl p-3 space-y-2">
                        @php
                            $dayNames = ['senin'=>'Senin','selasa'=>'Selasa','rabu'=>'Rabu','kamis'=>'Kamis','jumat'=>'Jumat','sabtu'=>'Sabtu','minggu'=>'Minggu'];
                        @endphp
                        @foreach($dayNames as $key => $label)
                            @if(isset($doctor->schedule[$key]) && count($doctor->schedule[$key]))
                            <div class="flex items-start gap-2">
                                <span class="text-xs font-semibold text-blue-700 w-14 flex-shrink-0 pt-0.5">{{ $label }}</span>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($doctor->schedule[$key] as $time)
                                    <span class="bg-white text-blue-700 text-xs px-2 py-0.5 rounded-full border border-blue-200">{{ $time }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400">Biaya Konsultasi</p>
                        <p class="font-bold text-green-600">Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('public.doctor.detail', $doctor) }}" class="border border-green-500 text-green-600 text-sm px-3 py-2 rounded-lg hover:bg-green-50 transition">
                            Detail
                        </a>
                        @auth
                            @if(auth()->user()->isPasien())
                            <a href="{{ route('pasien.appointments.create') }}" class="bg-green-500 text-white text-sm px-3 py-2 rounded-lg hover:bg-green-600 transition">
                                Buat Janji
                            </a>
                            @endif
                        @else
                        <a href="{{ route('login') }}" class="bg-green-500 text-white text-sm px-3 py-2 rounded-lg hover:bg-green-600 transition">
                            Buat Janji
                        </a>
                        @endauth
                    </div>
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
