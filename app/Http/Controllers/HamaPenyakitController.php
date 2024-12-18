<?php

namespace App\Http\Controllers;

use App\Models\HamaPenyakit;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HamaPenyakitController extends Controller
{
    public function index()
    {
        $hamaPenyakits = HamaPenyakit::with(['tanaman.lahan.ppl'])
            ->latest('tanggal_laporan')
            ->paginate(10);
            
        return view('hamas.index', compact('hamaPenyakits'));
    }

    public function create()
    {
        $tanamans = Tanaman::with('lahan')->get();
        return view('hamas.create', compact('tanamans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_tanaman' => 'required|exists:tanamans,id_tanaman',
            'jenis' => 'required|in:hama,virus,penyakit',
            'nama' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
            'tingkat_serangan' => 'required|in:ringan,sedang,berat',
            'gejala' => 'required|string',
            'penanganan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048' // max 2MB
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('hama-penyakit', 'public');
        }

        $validated['status'] = 'proses'; // default status

        HamaPenyakit::create($validated);

        return redirect()->route('hamas.index')
            ->with('success', 'Laporan hama & penyakit berhasil ditambahkan');
    }

    public function show(HamaPenyakit $hama)
    {
        return view('hamas.show', compact('hama'));
    }

    public function edit(HamaPenyakit $hama)
    {
        $tanamans = Tanaman::with('lahan')->get();
        return view('hamas.edit', compact('hama', 'tanamans'));
    }

    public function update(Request $request, HamaPenyakit $hama)
    {
        $validated = $request->validate([
            'id_tanaman' => 'required|exists:tanamans,id_tanaman',
            'jenis' => 'required|in:hama,virus,penyakit',
            'nama' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
            'tingkat_serangan' => 'required|in:ringan,sedang,berat',
            'status' => 'required|in:proses,teratasi',
            'gejala' => 'required|string',
            'penanganan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($hama->foto) {
                Storage::disk('public')->delete($hama->foto);
            }
            $validated['foto'] = $request->file('foto')->store('hama-penyakit', 'public');
        }

        $hama->update($validated);

        return redirect()->route('hamas.index')
            ->with('success', 'Laporan hama & penyakit berhasil diperbarui');
    }

    public function destroy(HamaPenyakit $hama)
    {
        if ($hama->foto) {
            Storage::disk('public')->delete($hama->foto);
        }
        
        $hama->delete();

        return redirect()->route('hamas.index')
            ->with('success', 'Laporan hama & penyakit berhasil dihapus');
    }

    public function filter(Request $request)
    {
        $query = HamaPenyakit::with(['tanaman.lahan.ppl']);

        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->tanggal_dari) {
            $query->whereDate('tanggal_laporan', '>=', $request->tanggal_dari);
        }

        if ($request->tanggal_sampai) {
            $query->whereDate('tanggal_laporan', '<=', $request->tanggal_sampai);
        }

        $hamaPenyakits = $query->latest('tanggal_laporan')->paginate(10);
        $hamaPenyakits->appends($request->all());

        return view('hamas.index', compact('hamaPenyakits'));
    }
}
