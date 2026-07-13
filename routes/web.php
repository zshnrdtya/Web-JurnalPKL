<?php

use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $totalKegiatan = \App\Models\Kegiatan::where('user_id', auth()->id())->count();

        $kegiatanTerakhir = \App\Models\Kegiatan::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->take(5)
            ->get();

        $sudahIsiHariIni = \App\Models\Kegiatan::where('user_id', auth()->id())
            ->where('tanggal', now()->toDateString())
            ->exists();

        $totalMenitHariIni = \App\Models\Kegiatan::where('user_id', auth()->id())
            ->where('tanggal', now()->toDateString())
            ->get()
            ->sum(function ($k) {
                return \Carbon\Carbon::parse($k->jam_mulai)->diffInMinutes(\Carbon\Carbon::parse($k->jam_selesai));
            });

        return view('dashboard', compact(
            'totalKegiatan',
            'kegiatanTerakhir',
            'sudahIsiHariIni',
            'totalMenitHariIni'
        ));
    })->name('dashboard');

    Route::get('/kegiatan-export/pdf', [KegiatanController::class, 'exportPdf'])->name('kegiatan.export.pdf');
    Route::resource('kegiatan', KegiatanController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';