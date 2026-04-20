<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dokter') - Mari Sehat Selalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 min-h-screen" x-data="{ sidebarOpen: false }">

    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-blue-900 transform transition-transform duration-200 md:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        <div class="flex items-center gap-2 px-6 py-5 border-b border-blue-700">
            <div class="w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <p class="text-white font-bold text-sm">Portal Dokter</p>
                <p class="text-blue-300 text-xs">Mari Sehat Selalu</p>
            </div>
        </div>
        <nav class="px-4 py-4 space-y-1">
            <a href="{{ route('dokter.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dokter.dashboard') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="{{ route('dokter.appointments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dokter.appointments.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Jadwal Appointment
            </a>
            <a href="{{ route('dokter.patients.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('dokter.patients.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Riwayat Pasien
            </a>
        </nav>
        <div class="absolute bottom-0 left-0 right-0 px-4 py-4 border-t border-blue-700">
            <p class="text-blue-300 text-xs mb-1">{{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-blue-200 hover:text-white text-sm flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 md:hidden"></div>

    <div class="md:ml-64">
        <header class="bg-white shadow-sm px-4 py-4 flex items-center justify-between">
            <button @click="sidebarOpen = true" class="md:hidden">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-lg font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
            <span class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</span>
        </header>
        <main class="p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
