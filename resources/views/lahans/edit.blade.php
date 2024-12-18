@extends('layouts.app')

@section('title', 'Edit Lahan')

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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Lahan</div>

                <div class="card-body">
                    <form action="{{ route('lahans.update', $lahan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="pemilik" class="form-label">Pemilik Lahan</label>
                            <input type="text" class="form-control @error('pemilik') is-invalid @enderror" 
                                id="pemilik" name="pemilik" value="{{ old('pemilik', $lahan->pemilik) }}" required>
                            @error('pemilik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="luas" class="form-label">Luas (m²)</label>
                            <input type="number" step="0.01" class="form-control @error('luas') is-invalid @enderror" 
                                id="luas" name="luas" value="{{ old('luas', $lahan->luas) }}" required>
                            @error('luas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi Lahan</label>
                            <div id="map"></div>
                            <input type="hidden" id="latitude" name="latitude" 
                                value="{{ old('latitude', $lahan->latitude) }}" required>
                            <input type="hidden" id="longitude" name="longitude" 
                                value="{{ old('longitude', $lahan->longitude) }}" required>
                            @error('latitude')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $lahan->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('lahans.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Inisialisasi peta
    const map = L.map('map').setView([{{ $lahan->latitude }}, {{ $lahan->longitude }}], 13);
    let marker = L.marker([{{ $lahan->latitude }}, {{ $lahan->longitude }}]).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Fungsi untuk memindahkan marker
    function onMapClick(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    }

    map.on('click', onMapClick);
</script>
@endsection 