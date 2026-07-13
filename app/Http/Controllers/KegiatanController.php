<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Rules\JamTidakBentrok;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::where('user_id', auth()->id());

        if ($request->filled('dari')) {
            $query->where('tanggal', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->where('tanggal', '<=', $request->sampai);
        }

        if ($request->filled('cari')) {
            $query->where('uraian_kegiatan', 'like', '%' . $request->cari . '%');
        }

        $kegiatans = $query->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => [
                'required',
                'after:jam_mulai',
                new JamTidakBentrok($request->tanggal, $request->jam_mulai, auth()->id()),
            ],
            'uraian_kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        Kegiatan::create($validated);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil disimpan!');
    }

    public function edit(Kegiatan $kegiatan)
    {
        $this->authorizeAccess($kegiatan);

        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $this->authorizeAccess($kegiatan);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => [
                'required',
                'after:jam_mulai',
                new JamTidakBentrok($request->tanggal, $request->jam_mulai, auth()->id(), $kegiatan->id),
            ],
            'uraian_kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $kegiatan->update($validated);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil diupdate!');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $this->authorizeAccess($kegiatan);

        $kegiatan->delete();

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }

    public function exportPdf()
    {
        $kegiatans = Kegiatan::where('user_id', auth()->id())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        $pdf = Pdf::loadView('kegiatan.pdf', [
            'kegiatans' => $kegiatans,
            'user' => auth()->user(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-kegiatan-pkl.pdf');
    }

    private function authorizeAccess(Kegiatan $kegiatan)
    {
        if ($kegiatan->user_id !== auth()->id()) {
            abort(403, 'Kamu tidak punya akses ke data ini.');
        }
    }
}