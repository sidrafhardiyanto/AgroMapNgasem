@extends('layouts.app')

@section('title', 'Detail Hama & Penyakit')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Laporan Hama & Penyakit</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanaman</label>
                                <p>{{ $hama->tanaman->Jenis_Tanaman }} - {{ $hama->tanaman->Varietas }}</p>
                                <p class="text-muted">
                                    Lahan: {{ $hama->tanaman->lahan->pemilik }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis</label>
                                <p>{{ ucfirst($hama->jenis) }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Hama/Penyakit</label>
                                <p>{{ $hama->nama }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Laporan</label>
                                <p>{{ $hama->tanggal_laporan->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tingkat Serangan</label>
                                <p>
                                    <span class="badge bg-{{ $hama->tingkat_serangan == 'ringan' ? 'success' : 
                                        ($hama->tingkat_serangan == 'berat' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($hama->tingkat_serangan) }}
                                    </span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p>
                                    <span class="badge bg-{{ $hama->status == 'teratasi' ? 'success' : 'warning' }}">
                                        {{ ucfirst($hama->status) }}
                                    </span>
                                </p>
                            </div>

                            @if($hama->foto)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Foto</label>
                                <div>
                                    <img src="{{ asset('storage/' . $hama->foto) }}" alt="Foto" class="img-fluid rounded">
                                    <div class="mt-2 small text-muted">
                                        Path: {{ $hama->foto }}<br>
                                        Full URL: {{ asset('storage/' . $hama->foto) }}
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="mb-3">
                                <label class="form-label fw-bold">Foto</label>
                                <p class="text-muted">Tidak ada foto</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Gejala</label>
                        <p>{{ $hama->gejala }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Penanganan yang Sudah Dilakukan</label>
                        <p>{{ $hama->penanganan ?? '-' }}</p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('hamas.edit', $hama) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('hamas.destroy', $hama) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                        <a href="{{ route('hamas.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 