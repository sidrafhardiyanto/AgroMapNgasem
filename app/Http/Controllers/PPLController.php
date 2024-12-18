<?php

namespace App\Http\Controllers;

use App\Models\PenyuluhPetaniLapangan;
use Illuminate\Http\Request;

class PPLController extends Controller
{
    // Menampilkan daftar PPL
    public function index()
    {
        $ppls = PenyuluhPetaniLapangan::latest()->paginate(10);
        return view('ppls.index', compact('ppls'));
    }

    // Menampilkan form untuk menambah PPL
    public function create()
    {
        return view('ppls.create');
    }

    // Menyimpan PPL baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:penyuluh_petani_lapangan,Email',
            'Password' => 'required|min:6',
            'no_telepon' => 'nullable|string|max:15'
        ]);

        $validated['Password'] = bcrypt($validated['Password']);

        PenyuluhPetaniLapangan::create($validated);

        return redirect()->route('ppls.index')
            ->with('success', 'Data PPL berhasil ditambahkan');
    }

    // Menampilkan detail PPL
    public function show(PenyuluhPetaniLapangan $ppl)
    {
        return view('ppls.show', compact('ppl'));
    }

    // Menampilkan form untuk mengedit PPL
    public function edit(PenyuluhPetaniLapangan $ppl)
    {
        return view('ppls.edit', compact('ppl'));
    }

    // Memperbarui PPL
    public function update(Request $request, PenyuluhPetaniLapangan $ppl)
    {
        $validated = $request->validate([
            'Nama' => 'required|string|max:255',
            'Email' => 'required|email|unique:penyuluh_petani_lapangan,Email,' . $ppl->id_ppl . ',id_ppl',
            'Password' => 'nullable|min:6',
            'no_telepon' => 'nullable|string|max:15'
        ]);

        if ($validated['Password']) {
            $validated['Password'] = bcrypt($validated['Password']);
        } else {
            unset($validated['Password']);
        }

        $ppl->update($validated);

        return redirect()->route('ppls.index')
            ->with('success', 'Data PPL berhasil diperbarui');
    }

    // Menghapus PPL
    public function destroy(PenyuluhPetaniLapangan $ppl)
    {
        $ppl->delete();

        return redirect()->route('ppls.index')
            ->with('success', 'Data PPL berhasil dihapus');
    }
}
