<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;

class LahanController extends Controller
{
    public function index()
    {
        $lahans = Lahan::with(['tanamans'])
            ->latest()
            ->paginate(10);
            
        return view('lahans.index', compact('lahans'));
    }

    public function create()
    {
        return view('lahans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemilik' => 'required|string|max:255',
            'luas' => 'required|numeric|min:0',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'nullable|string'
        ]);

        // Generate lokasi string dari koordinat
        $validated['lokasi'] = "Lat: {$request->latitude}, Long: {$request->longitude}";

        Lahan::create($validated);

        return redirect()->route('lahans.index')
            ->with('success', 'Data lahan berhasil ditambahkan');
    }

    public function show(Lahan $lahan)
    {
        return view('lahans.show', compact('lahan'));
    }

    public function edit(Lahan $lahan)
    {
        return view('lahans.edit', compact('lahan'));
    }

    public function update(Request $request, Lahan $lahan)
    {
        $validated = $request->validate([
            'pemilik' => 'required|string|max:255',
            'luas' => 'required|numeric|min:0',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'nullable|string'
        ]);

        // Update lokasi string dari koordinat
        $validated['lokasi'] = "Lat: {$request->latitude}, Long: {$request->longitude}";

        $lahan->update($validated);

        return redirect()->route('lahans.index')
            ->with('success', 'Data lahan berhasil diperbarui');
    }

    public function destroy(Lahan $lahan)
    {
        $lahan->delete();
        return redirect()->route('lahans.index')
            ->with('success', 'Data lahan berhasil dihapus');
    }
}
