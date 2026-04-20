<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Apoteker') - Mari Sehat Selalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 min-h-screen" x-data="{ sidebarOpen: false }">

    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-purple-900 transform transition-transform duration-200 md:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        <div class="flex items-center gap-2 px-6 py-5 border-b border-purple-700">
            <div class="w-8 h-8 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            </div>
            <div>
                <p class="text-white font-bold text-sm">Portal Apoteker</p>
                <p class="text-purple-300 text-xs">Mari Sehat Selalu</p>
            </div>
        </div>
        <nav class="px-4 py-4 space-y-1">
            <a href="{{ route('apoteker.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('apoteker.dashboard') ? 'bg-purple-700 text-white' : 'text-purple-200 hover:bg-purple-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="{{ route('apoteker.prescriptions.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('apoteker.prescriptions.*') ? 'bg-purple-700 text-white' : 'text-purple-200 hover:bg-purple-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                Kelola Resep
            </a>
            <a href="{{ route('apoteker.medicines.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('apoteker.medicines.*') ? 'bg-purple-700 text-white' : 'text-purple-200 hover:bg-purple-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                Kelola Obat
            </a>
            <a href="{{ route('apoteker.transactions.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('apoteker.transactions.*') ? 'bg-purple-700 text-white' : 'text-purple-200 hover:bg-purple-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/></svg>
                Transaksi
            </a>
        </nav>
        <div class="absolute bottom-0 left-0 right-0 px-4 py-4 border-t border-purple-700">
            <p class="text-purple-300 text-xs mb-1">{{ auth()->user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-purple-200 hover:text-white text-sm flex items-center gap-1">
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
