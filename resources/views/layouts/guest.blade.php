<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Jurnal PKL' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen flex items-center justify-center px-4 py-8">

    <div class="w-full max-w-md">
        <!-- Logo / Judul -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-600 rounded-2xl mb-3 shadow-lg shadow-blue-200">
                <span class="text-2xl">📘</span>
            </div>
            <h1 class="text-xl font-bold text-gray-800">Jurnal PKL</h1>
            <p class="text-sm text-gray-500 mt-1">Catat kegiatan PKL kamu setiap hari</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 sm:p-8">
            {{ $slot }}
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} Jurnal PKL. Dibuat Oleh Raditya Rai Zeeshan untuk Mempermudah User dalam Mencatat Kegiatan PKL. <br>
        </p>
    </div>

</body>
</html>