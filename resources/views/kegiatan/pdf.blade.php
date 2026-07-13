<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Kegiatan PKL</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 4px; }
        p.subtitle { text-align: center; margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; vertical-align: top; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Kegiatan PKL</h2>
    <p class="subtitle">Nama: {{ $user->name }}</p>
    @if($user->nama_perusahaan)
        <p class="subtitle">Tempat PKL: {{ $user->nama_perusahaan }}</p>
    @endif
    @if($user->alamat_perusahaan)
        <p class="subtitle">Alamat: {{ $user->alamat_perusahaan }}</p>
    @endif
    @if($user->pembimbing_lapangan)
        <p class="subtitle">Pembimbing Lapangan: {{ $user->pembimbing_lapangan }}</p>
    @endif
    <p class="subtitle">Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 15%">Jam</th>
                <th style="width: 40%">Uraian Kegiatan</th>
                <th style="width: 30%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatans as $k)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }}</td>
                    <td>{{ substr($k->jam_mulai,0,5) }} - {{ substr($k->jam_selesai,0,5) }}</td>
                    <td>{{ $k->uraian_kegiatan }}</td>
                    <td>{{ $k->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>