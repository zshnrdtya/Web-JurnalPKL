<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Jurnal PKL' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen" x-data="{ mobileMenuOpen: false }">

    <!-- Navbar -->
    <nav class="glass-nav sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('dashboard') }}" class="font-bold text-lg text-indigo-700 tracking-tight">
                    📘 Jurnal PKL
                </a>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-700' : 'text-gray-600 hover:text-blue-700' }}">Dashboard</a>
                    <a href="{{ route('kegiatan.index') }}" class="text-sm font-medium {{ request()->routeIs('kegiatan.*') ? 'text-blue-700' : 'text-gray-600 hover:text-blue-700' }}">Riwayat</a>
                    <a href="{{ route('kegiatan.create') }}" class="text-sm font-medium {{ request()->routeIs('kegiatan.create') ? 'text-blue-700' : 'text-gray-600 hover:text-blue-700' }}">Isi Jurnal</a>
                    <a href="{{ route('profile.edit') }}" class="text-sm font-medium {{ request()->routeIs('profile.edit') ? 'text-blue-700' : 'text-gray-600 hover:text-blue-700' }}">Profil</a>

                    <div class="flex items-center gap-3 pl-4 border-l">
                        <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">Logout</button>
                        </form>
                    </div>
                </div>

                <!-- Tombol Hamburger (mobile) -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-600">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Menu Mobile -->
            <div x-show="mobileMenuOpen" style="display:none" class="md:hidden pb-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">Dashboard</a>
                <a href="{{ route('kegiatan.index') }}" class="block px-3 py-2 rounded text-sm font-medium {{ request()->routeIs('kegiatan.index') || request()->routeIs('kegiatan.edit') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">Riwayat</a>
                <a href="{{ route('kegiatan.create') }}" class="block px-3 py-2 rounded text-sm font-medium {{ request()->routeIs('kegiatan.create') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">Isi Jurnal</a>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded text-sm font-medium {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">Profil</a>
                <div class="border-t pt-2 mt-2">
                    <div class="px-3 py-1 text-xs text-gray-400">Masuk sebagai {{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}" class="px-3">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 py-1">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <main class="max-w-5xl mx-auto px-4 py-6">
        @if(session('success'))
            <div class="status-success bg-emerald-100/70 border border-emerald-200/70 text-emerald-800 px-4 py-3 mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
