<x-guest-layout>
    <h2 class="text-lg font-semibold text-gray-800 mb-1">Masuk ke Akun</h2>
    <p class="text-sm text-gray-500 mb-6">Yuk lanjutkan isi jurnal PKL kamu</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 px-3 py-2 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                placeholder="nama@email.com"
                class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
            @error('email')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                placeholder="••••••••"
                class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
            @error('password')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit"
            class="btn-primary w-full text-white py-2.5 rounded-lg text-sm font-medium transition">
            Masuk
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">Daftar sekarang</a>
    </p>
</x-guest-layout>
