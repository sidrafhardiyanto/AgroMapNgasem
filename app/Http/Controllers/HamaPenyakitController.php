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
        $hamaPenyakits = HamaPenyakit::with(['tanaman.lahan'])
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
            'ID_Tanaman' => 'required|exists:tanamans,ID_Tanaman',
            'jenis' => 'required|in:hama,virus,penyakit',
            'nama' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
            'tingkat_serangan' => 'required|in:ringan,sedang,berat',
            'gejala' => 'required|string',
            'penanganan' => 'nullable|string',
            'foto' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('hama-penyakit', 'public');
        }

        $validated['status'] = 'proses';

        HamaPenyakit::create($validated);

        return redirect()->route('hamas.index')
            ->with('success', 'Laporan hama & penyakit berhasil ditambahkan');
    }

    public function show(HamaPenyakit $hama)
    {
        $hama->load('tanaman.lahan');
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
            'ID_Tanaman' => 'required|exists:tanamans,ID_Tanaman',
            'jenis' => 'required|in:hama,virus,penyakit',
            'nama' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
            'tingkat_serangan' => 'required|in:ringan,sedang,berat',
            'status' => 'required|in:proses,teratasi',
            'gejala' => 'required|string',
            'penanganan' => 'nullable|string',
            'foto' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($request->hasFile('foto')) {
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
        $query = HamaPenyakit::with(['tanaman.lahan']);

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
