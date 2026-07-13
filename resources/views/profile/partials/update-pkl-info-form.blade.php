<section>
    <header>
        <h2 class="text-lg font-semibold text-gray-800">Data Tempat PKL</h2>
        <p class="text-sm text-gray-500 mt-1">Info ini bakal muncul di laporan PDF kamu.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('patch')

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Perusahaan / Instansi</label>
            <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', auth()->user()->nama_perusahaan) }}"
                placeholder="Misal: PT Teknologi Maju"
                class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
            @error('nama_perusahaan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Alamat Perusahaan</label>
            <input type="text" name="alamat_perusahaan" value="{{ old('alamat_perusahaan', auth()->user()->alamat_perusahaan) }}"
                placeholder="Jl. Contoh No. 123, Kota"
                class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
            @error('alamat_perusahaan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Pembimbing Lapangan</label>
            <input type="text" name="pembimbing_lapangan" value="{{ old('pembimbing_lapangan', auth()->user()->pembimbing_lapangan) }}"
                placeholder="Nama pembimbing di tempat PKL"
                class="w-full border rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
            @error('pembimbing_lapangan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                Simpan
            </button>

            @if (session('status') === 'pkl-info-updated')
                <p class="text-sm text-green-600">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>