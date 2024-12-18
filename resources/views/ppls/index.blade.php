@extends('layouts.app')

@section('title', 'Daftar PPL')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Penyuluh Petani Lapangan</h2>
        <a href="{{ route('ppls.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah PPL
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ppls as $ppl)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ppl->Nama }}</td>
                    <td>{{ $ppl->Email }}</td>
                    <td>{{ $ppl->no_telepon ?? '-' }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('ppls.show', $ppl) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('ppls.edit', $ppl) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('ppls.destroy', $ppl) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data PPL</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $ppls->links() }}
    </div>
</div>
@endsection 