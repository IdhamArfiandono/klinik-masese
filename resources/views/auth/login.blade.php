<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Mari Sehat Selalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 via-white to-green-100 flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <!-- Logo & Brand -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Mari Sehat Selalu</h1>
            <p class="text-gray-500 text-sm mt-1">Klinik & Apotek Terpercaya</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-1">Selamat Datang</h2>
            <p class="text-gray-400 text-sm mb-6">Masuk ke akun Anda untuk melanjutkan</p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" x-data="{ showPass: false }">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="nama@email.com"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-green-400 focus:border-transparent outline-none transition @error('email') border-red-400 bg-red-50 @enderror">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-green-600 hover:underline">
                                Lupa password?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password" :type="showPass ? 'text' : 'password'" name="password" required
                            placeholder="Masukkan password"
                            class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-green-400 focus:border-transparent outline-none transition @error('password') border-red-400 bg-red-50 @enderror">
                        <button type="button" @click="showPass = !showPass"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-5">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-400">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2.5 px-4 rounded-xl transition duration-150 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
                    Masuk
                </button>
            </form>

            @if (Route::has('register'))
            <p class="text-center text-sm text-gray-500 mt-5">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-green-600 font-medium hover:underline">Daftar sekarang</a>
            </p>
            @endif
        </div>

        <!-- Back to home -->
        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-green-600 flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</body>
</html>
