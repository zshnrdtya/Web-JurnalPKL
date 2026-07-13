@extends('layouts.app')

@section('content')
<div class="glass-panel max-w-lg mx-auto">
    <h2 class="text-lg font-semibold mb-4 text-gray-800">Edit Kegiatan</h2>

    <form action="{{ route('kegiatan.update', $kegiatan) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}"
                class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('tanggal') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', substr($kegiatan->jam_mulai, 0, 5)) }}"
                    class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('jam_mulai') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai', substr($kegiatan->jam_selesai, 0, 5)) }}"
                    class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('jam_selesai') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Uraian Kegiatan</label>
            <input type="text" name="uraian_kegiatan" value="{{ old('uraian_kegiatan', $kegiatan->uraian_kegiatan) }}"
                class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('uraian_kegiatan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Keterangan (opsional)</label>
            <textarea name="keterangan" rows="3"
                class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('keterangan', $kegiatan->keterangan) }}</textarea>
            @error('keterangan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2 pt-2">
            <button type="submit" class="btn-primary flex-1 text-white py-2.5 rounded-lg text-sm font-medium">Simpan Perubahan</button>
            <a href="{{ route('kegiatan.index') }}" class="btn-secondary flex-1 text-center text-gray-700 py-2.5 rounded-lg text-sm font-medium">Batal</a>
        </div>
    </form>
</div>
@endsection
