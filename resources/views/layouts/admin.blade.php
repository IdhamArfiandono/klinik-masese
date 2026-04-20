<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Mari Sehat Selalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 min-h-screen" x-data="{ sidebarOpen: false }">

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-green-900 transform transition-transform duration-200
        md:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        <div class="flex items-center gap-2 px-6 py-5 border-b border-green-700">
            <div class="w-8 h-8 bg-green-400 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-white font-bold text-sm">Mari Sehat Selalu</p>
                <p class="text-green-300 text-xs">Panel Admin</p>
            </div>
        </div>
        <nav class="px-4 py-4 space-y-1">
            <x-sidebar-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" icon="home">Dashboard</x-sidebar-link>
            <x-sidebar-link href="{{ route('admin.appointments.index') }}" :active="request()->routeIs('admin.appointments.*')" icon="calendar">Appointment</x-sidebar-link>
            <x-sidebar-link href="{{ route('admin.doctors.index') }}" :active="request()->routeIs('admin.doctors.*')" icon="user-md">Kelola Dokter</x-sidebar-link>
            <x-sidebar-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')" icon="users">Kelola User</x-sidebar-link>
            <x-sidebar-link href="{{ route('admin.reports.index') }}" :active="request()->routeIs('admin.reports.*')" icon="chart">Laporan</x-sidebar-link>
        </nav>
        <div class="absolute bottom-0 left-0 right-0 px-4 py-4 border-t border-green-700">
            <p class="text-green-300 text-xs mb-1">{{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-green-200 hover:text-white text-sm flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 md:hidden"></div>

    <!-- Main -->
    <div class="md:ml-64">
        <header class="bg-white shadow-sm px-4 py-4 flex items-center justify-between">
            <button @click="sidebarOpen = true" class="md:hidden">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-lg font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
            <span class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</span>
        </header>

        <main class="p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
