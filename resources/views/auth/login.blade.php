<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login - Sistem Informasi Manajemen UPT Laboratorium Komputer STMIK Adhi Guna">
    <title>Login — SILAB</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 font-sans text-slate-800 antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Header Card -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-lg bg-indigo-600 shadow-lg shadow-indigo-200 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">SILAB</h1>
            <p class="text-slate-600 text-sm font-medium">Sistem Informasi Lab Komputer</p>
            <p class="text-slate-500 text-xs mt-1">STMIK Adhi Guna</p>
        </div>

        <!-- Login Form Card -->
        <div class="bg-white rounded-xl shadow-lg shadow-slate-200 p-8 overflow-hidden relative">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-50 rounded-full -mr-20 -mt-20 opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-indigo-50 rounded-full -ml-16 -mb-16 opacity-50"></div>

            <!-- Form Content -->
            <div class="relative z-10">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Masuk ke Akun Anda</h2>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-rose-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-rose-900 text-sm">Login Gagal</p>
                                <ul class="text-rose-800 text-sm mt-2 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- NIDN / Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">NIDN atau Email</label>
                        <div class="relative group">
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 transition-all duration-200 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 hover:border-slate-300 @error('email') border-rose-500 focus:ring-rose-100 @enderror"
                                placeholder="nama@email.com"
                            >
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 group-focus-within:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @error('email')
                            <p class="text-rose-600 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi</label>
                        <div class="relative group">
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 transition-all duration-200 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 hover:border-slate-300 @error('password') border-rose-500 focus:ring-rose-100 @enderror"
                                placeholder="••••••••"
                            >
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 group-focus-within:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        @error('password')
                            <p class="text-rose-600 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="flex items-center gap-2">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            class="w-4 h-4 bg-slate-50 border-2 border-slate-200 rounded text-indigo-600 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer"
                        >
                        <label for="remember" class="text-sm text-slate-600 cursor-pointer font-medium">Ingat saya</label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-2.5 px-4 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:shadow-lg active:scale-95 mt-6"
                    >
                        <span class="flex items-center justify-center gap-2">
                            <span>Masuk</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-3 my-6">
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <span class="text-xs text-slate-500 font-medium">Butuh Bantuan?</span>
                    <div class="flex-1 h-px bg-slate-200"></div>
                </div>

                <!-- Footer Links -->
                <div class="flex flex-col gap-3 text-center text-sm">
                    <p class="text-slate-600">
                        Hubungi administrator jika Anda mengalami kesulitan login.
                        <a href="mailto:admin@stmik.ac.id" class="text-indigo-600 hover:text-indigo-700 font-semibold transition-colors">Kontak Kami</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-xs text-slate-500">
                © 2026 STMIK Adhi Guna. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>

    <!-- Background Gradient Overlay -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-32 left-0 w-80 h-80 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
    </div>
</body>
</html>
