@extends('layouts.app')

@section('title', 'Tambah Laporan Hama & Penyakit')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Laporan Hama & Penyakit</div>

                <div class="card-body">
                    <form action="{{ route('hamas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="ID_Tanaman" class="form-label">Tanaman</label>
                            <select class="form-select @error('ID_Tanaman') is-invalid @enderror" 
                                id="ID_Tanaman" name="ID_Tanaman" required>
                                <option value="">Pilih Tanaman</option>
                                @foreach($tanamans as $tanaman)
                                    <option value="{{ $tanaman->ID_Tanaman }}" 
                                        {{ old('ID_Tanaman', request('tanaman_id')) == $tanaman->ID_Tanaman ? 'selected' : '' }}>
                                        {{ $tanaman->Jenis_Tanaman }} - {{ $tanaman->Varietas }} 
                                        ({{ $tanaman->lahan->pemilik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('ID_Tanaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                                <option value="">Pilih Jenis</option>
                                <option value="hama" {{ old('jenis') == 'hama' ? 'selected' : '' }}>Hama</option>
                                <option value="virus" {{ old('jenis') == 'virus' ? 'selected' : '' }}>Virus</option>
                                <option value="penyakit" {{ old('jenis') == 'penyakit' ? 'selected' : '' }}>Penyakit</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Hama/Penyakit</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_laporan" class="form-label">Tanggal Laporan</label>
                            <input type="date" class="form-control @error('tanggal_laporan') is-invalid @enderror" 
                                id="tanggal_laporan" name="tanggal_laporan" value="{{ old('tanggal_laporan') }}" required>
                            @error('tanggal_laporan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tingkat_serangan" class="form-label">Tingkat Serangan</label>
                            <select class="form-select @error('tingkat_serangan') is-invalid @enderror" 
                                id="tingkat_serangan" name="tingkat_serangan" required>
                                <option value="">Pilih Tingkat Serangan</option>
                                <option value="ringan" {{ old('tingkat_serangan') == 'ringan' ? 'selected' : '' }}>Ringan</option>
                                <option value="sedang" {{ old('tingkat_serangan') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="berat" {{ old('tingkat_serangan') == 'berat' ? 'selected' : '' }}>Berat</option>
                            </select>
                            @error('tingkat_serangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gejala" class="form-label">Gejala</label>
                            <textarea class="form-control @error('gejala') is-invalid @enderror" 
                                id="gejala" name="gejala" rows="3" required>{{ old('gejala') }}</textarea>
                            @error('gejala')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="penanganan" class="form-label">Penanganan yang Sudah Dilakukan</label>
                            <textarea class="form-control @error('penanganan') is-invalid @enderror" 
                                id="penanganan" name="penanganan" rows="3">{{ old('penanganan') }}</textarea>
                            @error('penanganan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                id="foto" name="foto" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('hamas.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 