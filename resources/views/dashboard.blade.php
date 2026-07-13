@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-xl md:text-2xl font-bold text-gray-800">Halo, {{ auth()->user()->name }} 👋</h1>
    <p class="text-gray-500 text-sm">Ini ringkasan jurnal PKL kamu.</p>
</div>

<!-- Reminder / Status Hari Ini -->
@if(!$sudahIsiHariIni)
    <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-lg mb-4 text-sm flex items-center gap-2">
        ⏰ Kamu belum isi jurnal hari ini. <a href="{{ route('kegiatan.create') }}" class="font-semibold underline">Isi sekarang</a>
    </div>
@else
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 text-sm">
        ✅ Total jam kerja hari ini: <strong>{{ floor($totalMenitHariIni / 60) }} jam {{ $totalMenitHariIni % 60 }} menit</strong>
        @if($totalMenitHariIni < 480)
            <span class="text-amber-700">(masih di bawah 8 jam)</span>
        @endif
    </div>
@endif

<!-- Stat Card -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm border p-5">
        <p class="text-gray-500 text-sm">Total Kegiatan Tercatat</p>
        <p class="text-3xl font-bold text-blue-700 mt-1">{{ $totalKegiatan }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border p-5 flex flex-col justify-center gap-2">
        <a href="{{ route('kegiatan.create') }}" class="bg-blue-600 text-white text-center py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
            + Isi Jurnal Hari Ini
        </a>
        <a href="{{ route('kegiatan.index') }}" class="bg-gray-100 text-gray-700 text-center py-2 rounded-lg text-sm font-medium hover:bg-gray-200">
            Lihat Semua Riwayat
        </a>
    </div>
</div>

<!-- Riwayat Terakhir -->
<div class="bg-white rounded-xl shadow-sm border">
    <div class="px-5 py-4 border-b">
        <h2 class="font-semibold text-gray-800">Kegiatan Terbaru</h2>
    </div>

    @forelse($kegiatanTerakhir as $k)
        <div class="px-5 py-4 border-b last:border-0">
            <div class="flex justify-between items-start gap-2">
                <div>
                    <p class="text-sm font-medium text-gray-800">{{ $k->uraian_kegiatan }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }} ·
                        {{ substr($k->jam_mulai,0,5) }}-{{ substr($k->jam_selesai,0,5) }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="px-5 py-8 text-center text-gray-400 text-sm">
            Belum ada kegiatan tercatat. Yuk mulai isi jurnal hari ini!
        </div>
    @endforelse
</div>
@endsection