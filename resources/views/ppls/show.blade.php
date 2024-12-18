@extends('layouts.app')

@section('title', 'Detail PPL')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail PPL</div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <p>{{ $ppl->Nama }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p>{{ $ppl->Email }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">No. Telepon</label>
                        <p>{{ $ppl->no_telepon ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Lahan yang Ditangani</label>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pemilik</th>
                                        <th>Luas (m²)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ppl->lahans as $lahan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lahan->pemilik }}</td>
                                        <td>{{ $lahan->luas }}</td>
                                        <td>
                                            <a href="{{ route('lahans.show', $lahan) }}" class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada lahan yang ditangani</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('ppls.edit', $ppl) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('ppls.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 