<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mari Sehat Selalu') - Klinik & Apotek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-green-700 text-lg">Mari Sehat Selalu</span>
                </a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 font-medium">Beranda</a>
                    <a href="{{ route('public.doctors') }}" class="text-gray-600 hover:text-green-600 font-medium">Dokter</a>
                    @auth
                        @php $role = auth()->user()->role; @endphp
                        <a href="{{ route($role.'.dashboard') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 font-medium">Daftar</a>
                    @endauth
                </div>
                <button @click="open = !open" class="md:hidden p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        <div x-show="open" class="md:hidden bg-white border-t px-4 py-3 space-y-2">
            <a href="{{ route('home') }}" class="block text-gray-600 py-1">Beranda</a>
            <a href="{{ route('public.doctors') }}" class="block text-gray-600 py-1">Dokter</a>
            @auth
                <a href="{{ route(auth()->user()->role.'.dashboard') }}" class="block text-green-600 py-1 font-medium">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block text-gray-600 py-1">Masuk</a>
                <a href="{{ route('register') }}" class="block text-green-600 py-1 font-medium">Daftar</a>
            @endauth
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-green-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-green-400 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <span class="font-bold text-lg">Mari Sehat Selalu</span>
                    </div>
                    <p class="text-green-200 text-sm">Klinik dan apotek terpercaya untuk kesehatan keluarga Anda.</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-3">Jam Operasional</h3>
                    <p class="text-green-200 text-sm">Senin - Jumat: 08.00 - 17.00</p>
                    <p class="text-green-200 text-sm">Sabtu: 08.00 - 13.00</p>
                    <p class="text-green-200 text-sm">Minggu: Tutup</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-3">Lokasi</h3>
                    <p class="text-green-200 text-sm">Jl. Sehat Raya No. 10</p>
                    <p class="text-green-200 text-sm">Jakarta Selatan, DKI Jakarta</p>
                    <p class="text-green-200 text-sm mt-2">Telp: (021) 555-0100</p>
                </div>
            </div>
            <div class="border-t border-green-700 mt-8 pt-6 text-center text-green-300 text-sm">
                &copy; {{ date('Y') }} Mari Sehat Selalu. Hak cipta dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>
