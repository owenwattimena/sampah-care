@extends('templates.index')

@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection

@section('title', 'Pengaduan')
@section('subtitle', 'Detail Pengaduan')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="card border-start border-info">
            <div class="card-body">
              <h5>Pengaduan</h5>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticNIK" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <span class="badge bg-{{$pengaduan->status == 'pending' ? 'danger' : ($pengaduan->status == 'proses' ? 'primary' : 'success') }}">{{$pengaduan->status}}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticNIK" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticNIK" value="{{$pengaduan->user->nik}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticNama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticNama" value="{{$pengaduan->user->nama}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticFoto" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                <img src="{{asset($pengaduan->foto)}}" alt="" width="50%">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticIsi" class="col-sm-2 col-form-label">Isi</label>
            <div class="col-sm-10">
                <textarea type="text" readonly class="form-control-plaintext" id="staticIsi" >{{$pengaduan->isi}}</textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticIsi" class="col-sm-2 col-form-label">Lokasi</label>
            <div class="col-sm-10">
                <div id="map" class="map map-home" style="height: 500px; margin-top: 50px"></div>
            </div>
        </div>
        <div class="card border-start border-info">
            <div class="card-body">
              <h5>Tanggapan</h5>
            </div>
        </div>
        <form action="{{route('pengaduan.tanggapi', $pengaduan->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="selectStatus" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select type="text" class="form-control" id="selectStatus" name="status" required>
                        @foreach (['pending', 'proses', 'selesai'] as $item)
                        <option value="{{$item}}" {{$pengaduan->status == $item ? 'selected' : ''}}>{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputTanggapan" class="col-sm-2 col-form-label">Isi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputTanggapan" name="isi" placeholder="Masukan Tanggapan">{{$pengaduan->tanggapan->isi ?? ''}}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputFoto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    @if ($pengaduan->tanggapan != null ) 
                    @if ($pengaduan->tanggapan->foto != null ) 
                    <img src="{{asset($pengaduan->tanggapan->foto)}}" alt="" width="50%" class="mb-3">
                    @endif 
                    @endif 
                    <input type="file" class="form-control" id="inputFoto" name="foto">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <button type="submit" class="form-control btn btn-success" >SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
   var osmUrl = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
		osmAttrib = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
		osm = L.tileLayer(osmUrl, {maxZoom: 18, attribution: osmAttrib});

	var map = L.map('map').setView([`{{$pengaduan->latitude}}`,`{{$pengaduan->longitude}}`], 15).addLayer(osm);

	L.marker([`{{$pengaduan->latitude}}`,`{{$pengaduan->longitude}}`])
		.addTo(map);
		// .bindPopup('A pretty CSS popup.<br />Easily customizable.')
		// .openPopup();
</script>
@endsection
