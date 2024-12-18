@extends('layouts.app')

@section('title', 'Tambah Tanaman')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Tanaman Baru</div>

                <div class="card-body">
                    <form action="{{ route('tanamans.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="ID_Lahan" class="form-label">Lahan</label>
                            <select class="form-select @error('ID_Lahan') is-invalid @enderror" 
                                id="ID_Lahan" name="ID_Lahan" required>
                                <option value="">Pilih Lahan</option>
                                @foreach($lahans as $lahan)
                                    <option value="{{ $lahan->ID_Lahan }}" 
                                        {{ old('ID_Lahan') == $lahan->ID_Lahan ? 'selected' : '' }}>
                                        {{ $lahan->pemilik }} ({{ $lahan->luas }} m²)
                                    </option>
                                @endforeach
                            </select>
                            @error('ID_Lahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Jenis_Tanaman" class="form-label">Jenis Tanaman</label>
                            <input type="text" class="form-control @error('Jenis_Tanaman') is-invalid @enderror" 
                                id="Jenis_Tanaman" name="Jenis_Tanaman" value="{{ old('Jenis_Tanaman') }}" required>
                            @error('Jenis_Tanaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Varietas" class="form-label">Varietas</label>
                            <input type="text" class="form-control @error('Varietas') is-invalid @enderror" 
                                id="Varietas" name="Varietas" value="{{ old('Varietas') }}" required>
                            @error('Varietas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Tanggal_Penanaman" class="form-label">Tanggal Tanam</label>
                            <input type="date" class="form-control @error('Tanggal_Penanaman') is-invalid @enderror" 
                                id="Tanggal_Penanaman" name="Tanggal_Penanaman" value="{{ old('Tanggal_Penanaman') }}" required>
                            @error('Tanggal_Penanaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Perkiraan_Panen" class="form-label">Perkiraan Tanggal Panen</label>
                            <input type="date" class="form-control @error('Perkiraan_Panen') is-invalid @enderror" 
                                id="Perkiraan_Panen" name="Perkiraan_Panen" value="{{ old('Perkiraan_Panen') }}">
                            @error('Perkiraan_Panen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Status" class="form-label">Status</label>
                            <select class="form-select @error('Status') is-invalid @enderror" id="Status" name="Status" required>
                                <option value="ditanam" {{ old('Status') == 'ditanam' ? 'selected' : '' }}>Ditanam</option>
                                <option value="tumbuh" {{ old('Status') == 'tumbuh' ? 'selected' : '' }}>Tumbuh</option>
                                <option value="panen" {{ old('Status') == 'panen' ? 'selected' : '' }}>Panen</option>
                                <option value="gagal" {{ old('Status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
                            </select>
                            @error('Status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('Catatan') is-invalid @enderror" 
                                id="Catatan" name="Catatan" rows="3">{{ old('Catatan') }}</textarea>
                            @error('Catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('tanamans.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 