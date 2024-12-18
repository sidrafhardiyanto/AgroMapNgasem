@extends('layouts.app')

@section('title', 'Daftar Tanaman')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Tanaman</h2>
        <a href="{{ route('tanamans.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Tanaman
        </a>
    </div>

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('tanamans.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="jenis_tanaman" class="form-label">Jenis Tanaman</label>
                    <input type="text" class="form-control" id="jenis_tanaman" name="jenis_tanaman" 
                        value="{{ request('jenis_tanaman') }}">
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="ditanam" {{ request('status') == 'ditanam' ? 'selected' : '' }}>Ditanam</option>
                        <option value="tumbuh" {{ request('status') == 'tumbuh' ? 'selected' : '' }}>Tumbuh</option>
                        <option value="panen" {{ request('status') == 'panen' ? 'selected' : '' }}>Panen</option>
                        <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tanggal_dari" class="form-label">Tanggal Tanam Dari</label>
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
                    <a href="{{ route('tanamans.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lahan</th>
                    <th>Jenis Tanaman</th>
                    <th>Varietas</th>
                    <th>Tanggal Tanam</th>
                    <th>Perkiraan Panen</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tanamans as $tanaman)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tanaman->lahan->pemilik }}</td>
                    <td>{{ $tanaman->Jenis_Tanaman }}</td>
                    <td>{{ $tanaman->Varietas }}</td>
                    <td>{{ $tanaman->Tanggal_Penanaman ? $tanaman->Tanggal_Penanaman->format('d/m/Y') : '-' }}</td>
                    <td>{{ $tanaman->Perkiraan_Panen ? $tanaman->Perkiraan_Panen->format('d/m/Y') : '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $tanaman->Status == 'panen' ? 'success' : 
                            ($tanaman->Status == 'gagal' ? 'danger' : 'info') }}">
                            {{ ucfirst($tanaman->Status) }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('tanamans.show', $tanaman) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('tanamans.edit', $tanaman) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tanamans.destroy', $tanaman) }}" method="POST" class="d-inline">
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
                    <td colspan="8" class="text-center">Tidak ada data tanaman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $tanamans->links() }}
    </div>
</div>
@endsection 