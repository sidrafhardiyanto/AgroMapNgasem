@extends('layouts.app')

@section('title', 'Tambah Lahan')

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
                <div class="card-header">Tambah Lahan Baru</div>

                <div class="card-body">
                    <form action="{{ route('lahans.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="pemilik" class="form-label">Pemilik Lahan</label>
                            <input type="text" class="form-control @error('pemilik') is-invalid @enderror" 
                                id="pemilik" name="pemilik" value="{{ old('pemilik') }}" required>
                            @error('pemilik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="luas" class="form-label">Luas (m²)</label>
                            <input type="number" step="0.01" class="form-control @error('luas') is-invalid @enderror" 
                                id="luas" name="luas" value="{{ old('luas') }}" required>
                            @error('luas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Lokasi Lahan</label>
                            <div id="map"></div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}" required>
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}" required>
                            @error('latitude')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
    const map = L.map('map').setView([-6.5943, 110.6654], 13);
    let marker;

    // Layer OpenStreetMap
    const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    });

    // Layer Google Satellite
    const googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3'],
        attribution: '© Google'
    });

    // Layer Google Hybrid (Satelit + Label)
    const googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3'],
        attribution: '© Google'
    });

    // Base layers
    const baseLayers = {
        "OpenStreetMap": osmLayer,
        "Satelit": googleSat,
        "Hybrid": googleHybrid
    };

    // Tambahkan control layer
    L.control.layers(baseLayers).addTo(map);

    // Set default layer
    osmLayer.addTo(map);

    // Fungsi untuk menambah/memindahkan marker
    function onMapClick(e) {
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    }

    map.on('click', onMapClick);

    // Jika ada nilai latitude dan longitude yang tersimpan
    const savedLat = "{{ old('latitude') }}";
    const savedLng = "{{ old('longitude') }}";
    if (savedLat && savedLng) {
        marker = L.marker([savedLat, savedLng]).addTo(map);
        map.setView([savedLat, savedLng], 13);
    }
</script>
@endsection 