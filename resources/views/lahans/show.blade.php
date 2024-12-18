@extends('layouts.app')

@section('title', 'Detail Lahan')

@section('styles')
<style>
    #map {
        height: 400px;
        width: 100%;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Lahan</h5>
                </div>
                <div class="card-body">
                    <div id="map"></div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Pemilik Lahan</label>
                            <p>{{ $lahan->pemilik }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Luas</label>
                            <p>{{ $lahan->luas }} m²</p>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan</label>
                        <p>{{ $lahan->keterangan ?? '-' }}</p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('lahans.edit', $lahan) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('lahans.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>

            <!-- Daftar Tanaman -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Tanaman yang Ditanam</h5>
                    <a href="{{ route('tanamans.create', ['lahan_id' => $lahan->id_lahan]) }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Tanaman
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Tanaman</th>
                                    <th>Varietas</th>
                                    <th>Tanggal Tanam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lahan->tanamans as $tanaman)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tanaman->jenis_tanaman }}</td>
                                    <td>{{ $tanaman->varietas }}</td>
                                    <td>{{ $tanaman->tanggal_tanam->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $tanaman->status == 'panen' ? 'success' : 
                                            ($tanaman->status == 'gagal' ? 'danger' : 'info') }}">
                                            {{ ucfirst($tanaman->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('tanamans.show', $tanaman) }}" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada tanaman yang ditanam</td>
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
            <!-- Rekomendasi Terbaru -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Rekomendasi Terbaru</h5>
                </div>
                <div class="card-body">
                    @forelse($lahan->rekomendasis->take(3) as $rekomendasi)
                    <div class="mb-3">
                        <h6>{{ $rekomendasi->judul }}</h6>
                        <p class="small text-muted">{{ $rekomendasi->tanggal_rekomendasi->format('d/m/Y') }}</p>
                        <p>{{ Str::limit($rekomendasi->isi_rekomendasi, 100) }}</p>
                    </div>
                    @empty
                    <p class="text-muted">Belum ada rekomendasi</p>
                    @endforelse
                </div>
            </div>

            <!-- Riwayat Hama & Penyakit -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Riwayat Hama & Penyakit</h5>
                </div>
                <div class="card-body">
                    @php
                        $hamaPenyakit = $lahan->tanamans->flatMap->hamaPenyakits->sortByDesc('tanggal_laporan')->take(5);
                    @endphp
                    @forelse($hamaPenyakit as $hama)
                    <div class="mb-3">
                        <h6>{{ $hama->nama }}</h6>
                        <p class="small text-muted">{{ $hama->tanggal_laporan->format('d/m/Y') }}</p>
                        <p>{{ Str::limit($hama->deskripsi, 100) }}</p>
                    </div>
                    @empty
                    <p class="text-muted">Belum ada riwayat hama & penyakit</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Inisialisasi peta
    const map = L.map('map').setView([{{ $lahan->latitude }}, {{ $lahan->longitude }}], 15);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker
    L.marker([{{ $lahan->latitude }}, {{ $lahan->longitude }}])
        .bindPopup("<b>{{ $lahan->pemilik }}</b><br>Luas: {{ $lahan->luas }} m²")
        .addTo(map);

    // Jika ada bentuk lahan (polygon)
    @if($lahan->bentuk_lahan)
        const polygon = L.polygon({!! $lahan->bentuk_lahan !!}, {
            color: 'green',
            fillColor: '#3388ff',
            fillOpacity: 0.2
        }).addTo(map);
        map.fitBounds(polygon.getBounds());
    @endif
</script>
@endsection 