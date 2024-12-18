@extends('layouts.app')

@section('title', 'Detail Tanaman')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Tanaman</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Jenis Tanaman</label>
                            <p>{{ $tanaman->Jenis_Tanaman }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Varietas</label>
                            <p>{{ $tanaman->Varietas }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Tanam</label>
                            <p>{{ $tanaman->Tanggal_Penanaman ? $tanaman->Tanggal_Penanaman->format('d/m/Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Perkiraan Panen</label>
                            <p>{{ $tanaman->Perkiraan_Panen ? $tanaman->Perkiraan_Panen->format('d/m/Y') : '-' }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p>
                            <span class="badge bg-{{ $tanaman->Status == 'panen' ? 'success' : 
                                ($tanaman->Status == 'gagal' ? 'danger' : 'info') }}">
                                {{ ucfirst($tanaman->Status) }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Catatan</label>
                        <p>{{ $tanaman->Catatan ?? '-' }}</p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('tanamans.edit', $tanaman) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('hamas.create', ['tanaman_id' => $tanaman->ID_Tanaman]) }}" 
                            class="btn btn-danger">Lapor Hama/Penyakit</a>
                        <a href="{{ route('tanamans.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>

            <!-- Riwayat Hama & Penyakit -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Riwayat Hama & Penyakit</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>Tingkat Serangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tanaman->hamas as $hama)
                                <tr>
                                    <td>{{ $hama->tanggal_laporan ? $hama->tanggal_laporan->format('d/m/Y') : '-' }}</td>
                                    <td>{{ ucfirst($hama->jenis) }}</td>
                                    <td>{{ $hama->nama }}</td>
                                    <td>
                                        <span class="badge bg-{{ $hama->tingkat_serangan == 'ringan' ? 'success' : 
                                            ($hama->tingkat_serangan == 'berat' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($hama->tingkat_serangan) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $hama->status == 'teratasi' ? 'success' : 'warning' }}">
                                            {{ ucfirst($hama->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('hamas.show', $hama) }}" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada riwayat hama & penyakit</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Statistik -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Usia Tanaman</label>
                        <h4>{{ $tanaman->Tanggal_Penanaman ? $tanaman->Tanggal_Penanaman->diffInDays(now()) : 0 }} Hari</h4>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Serangan Hama/Penyakit</label>
                        <h4>{{ $tanaman->hamas->count() }}</h4>
                    </div>
                    @if($tanaman->Perkiraan_Panen)
                    <div class="mb-3">
                        <label class="form-label">Perkiraan Waktu Panen</label>
                        <h4>{{ $tanaman->Perkiraan_Panen->diffInDays(now()) }} Hari Lagi</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 