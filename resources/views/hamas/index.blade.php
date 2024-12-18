@extends('layouts.app')

@section('title', 'Daftar Hama & Penyakit')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Hama & Penyakit</h2>
        <a href="{{ route('hamas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Laporan
        </a>
    </div>

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('hamas.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select" id="jenis" name="jenis">
                        <option value="">Semua Jenis</option>
                        <option value="hama" {{ request('jenis') == 'hama' ? 'selected' : '' }}>Hama</option>
                        <option value="virus" {{ request('jenis') == 'virus' ? 'selected' : '' }}>Virus</option>
                        <option value="penyakit" {{ request('jenis') == 'penyakit' ? 'selected' : '' }}>Penyakit</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="teratasi" {{ request('status') == 'teratasi' ? 'selected' : '' }}>Teratasi</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tanggal_dari" class="form-label">Tanggal Laporan Dari</label>
                    <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari" 
                        value="{{ request('tanggal_dari') }}">
                </div>
                <div class="col-md-3">
                    <label for="tanggal_sampai" class="form-label">Sampai</label>
                    <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai" 
                        value="{{ request('tanggal_sampai') }}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('hamas.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Tanaman</th>
                    <th>Jenis</th>
                    <th>Nama</th>
                    <th>Tingkat Serangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hamaPenyakits as $hama)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $hama->tanggal_laporan->format('d/m/Y') }}</td>
                    <td>{{ $hama->tanaman->jenis_tanaman }} ({{ $hama->tanaman->varietas }})</td>
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
                        <div class="btn-group" role="group">
                            <a href="{{ route('hamas.show', $hama) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('hamas.edit', $hama) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('hamas.destroy', $hama) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data hama & penyakit</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $hamaPenyakits->links() }}
    </div>
</div>
@endsection 