@extends('layouts.app')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-5">
    <h1 class="text-xl font-bold text-gray-800">Riwayat Kegiatan</h1>
    <div class="flex gap-2 w-full sm:w-auto">
        <a href="{{ route('kegiatan.create') }}" class="flex-1 sm:flex-none text-center bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
            + Tambah
        </a>
        <a href="{{ route('kegiatan.export.pdf') }}" class="flex-1 sm:flex-none text-center bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700">
            Export PDF
        </a>
    </div>
</div>

<!-- Form Filter -->
<form method="GET" action="{{ route('kegiatan.index') }}" class="bg-white rounded-xl shadow-sm border p-4 mb-5">
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
        <div>
            <label class="block mb-1 text-xs font-medium text-gray-600">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ request('dari') }}"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div>
            <label class="block mb-1 text-xs font-medium text-gray-600">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ request('sampai') }}"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="sm:col-span-2">
            <label class="block mb-1 text-xs font-medium text-gray-600">Cari Uraian Kegiatan</label>
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Misal: setup, meeting, dll"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
    </div>
    <div class="flex gap-2 mt-3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
            Filter
        </button>
        @if(request('dari') || request('sampai') || request('cari'))
            <a href="{{ route('kegiatan.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-200">
                Reset
            </a>
        @endif
    </div>
</form>

@forelse($kegiatans as $k)
    <div class="bg-white rounded-xl shadow-sm border p-4 mb-3">
        <div class="flex justify-between items-start gap-3">
            <div class="flex-1">
                <p class="text-xs text-gray-500">
                    {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }} ·
                    {{ substr($k->jam_mulai,0,5) }} - {{ substr($k->jam_selesai,0,5) }}
                </p>
                <p class="font-medium text-gray-800 mt-1">{{ $k->uraian_kegiatan }}</p>
                @if($k->keterangan)
                    <p class="text-sm text-gray-500 mt-1">{{ $k->keterangan }}</p>
                @endif
            </div>
            <div class="flex flex-col gap-2 text-sm shrink-0">
                <a href="{{ route('kegiatan.edit', $k->id) }}" class="text-blue-600 font-medium">Edit</a>
                <form action="{{ route('kegiatan.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kegiatan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 font-medium">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="bg-white rounded-xl shadow-sm border p-8 text-center text-gray-400 text-sm">
        Tidak ada kegiatan yang cocok dengan filter kamu.
    </div>
@endforelse

<!-- Pagination -->
<div class="mt-4">
    {{ $kegiatans->links() }}
</div>
@endsection