<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Jurnal PKL' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8">

    <div class="w-full max-w-md">
        <!-- Logo / Judul -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl mb-3 shadow-lg shadow-indigo-200">
                <span class="text-2xl">📘</span>
            </div>
            <h1 class="text-xl font-bold text-gray-800">Jurnal PKL</h1>
            <p class="text-sm text-gray-500 mt-1">Catat kegiatan PKL kamu setiap hari</p>
        </div>

        <!-- Card -->
        <div class="glass-panel">
            {{ $slot }}
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} Jurnal PKL. Dibuat Oleh Raditya Rai Zeeshan untuk Mempermudah User dalam Mencatat Kegiatan PKL. <br>
        </p>
    </div>

</body>
</html>
