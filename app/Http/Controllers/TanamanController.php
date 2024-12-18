<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use App\Models\Lahan;
use Illuminate\Http\Request;

class TanamanController extends Controller
{
    public function index()
    {
        $tanamans = Tanaman::with(['lahan'])
            ->latest()
            ->paginate(10);
            
        return view('tanamans.index', compact('tanamans'));
    }

    public function create()
    {
        $lahans = Lahan::all();
        return view('tanamans.create', compact('lahans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ID_Lahan' => 'required|exists:lahans,ID_Lahan',
            'Jenis_Tanaman' => 'required|string|max:255',
            'Varietas' => 'required|string|max:255',
            'Tanggal_Penanaman' => 'required|date',
            'Perkiraan_Panen' => 'nullable|date|after:Tanggal_Penanaman',
            'Status' => 'required|in:ditanam,tumbuh,panen,gagal',
            'Catatan' => 'nullable|string'
        ]);

        Tanaman::create($validated);

        return redirect()->route('tanamans.index')
            ->with('success', 'Data tanaman berhasil ditambahkan');
    }

    public function show(Tanaman $tanaman)
    {
        $tanaman->load('lahan');
        return view('tanamans.show', compact('tanaman'));
    }

    public function edit(Tanaman $tanaman)
    {
        $lahans = Lahan::all();
        return view('tanamans.edit', compact('tanaman', 'lahans'));
    }

    public function update(Request $request, Tanaman $tanaman)
    {
        $validated = $request->validate([
            'ID_Lahan' => 'required|exists:lahans,ID_Lahan',
            'Jenis_Tanaman' => 'required|string|max:255',
            'Varietas' => 'required|string|max:255',
            'Tanggal_Penanaman' => 'required|date',
            'Perkiraan_Panen' => 'nullable|date|after:Tanggal_Penanaman',
            'Status' => 'required|in:ditanam,tumbuh,panen,gagal',
            'Catatan' => 'nullable|string'
        ]);

        $tanaman->update($validated);

        return redirect()->route('tanamans.index')
            ->with('success', 'Data tanaman berhasil diperbarui');
    }

    public function destroy(Tanaman $tanaman)
    {
        $tanaman->delete();
        return redirect()->route('tanamans.index')
            ->with('success', 'Data tanaman berhasil dihapus');
    }

    public function filter(Request $request)
    {
        $query = Tanaman::with(['lahan']);

        if ($request->jenis_tanaman) {
            $query->where('Jenis_Tanaman', 'like', '%' . $request->jenis_tanaman . '%');
        }

        if ($request->status) {
            $query->where('Status', $request->status);
        }

        if ($request->tanggal_dari) {
            $query->whereDate('Tanggal_Penanaman', '>=', $request->tanggal_dari);
        }

        if ($request->tanggal_sampai) {
            $query->whereDate('Tanggal_Penanaman', '<=', $request->tanggal_sampai);
        }

        $tanamans = $query->latest()->paginate(10);
        $tanamans->appends($request->all());

        return view('tanamans.index', compact('tanamans'));
    }
}
