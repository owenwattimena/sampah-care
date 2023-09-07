@extends('templates.index')

@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection

@section('title', 'Pengaduan')
@section('subtitle', 'Daftar Pengaduan')


@section('content')
<div class="card">
    <div class="card-body">
        <div>
            <form action="">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="inputTglMulai" class="form-label">Awal</label>
                        <input type="date" class="form-control" id="inputTglMulai" name="awal" value="{{$awal}}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="inputTglAkhir" class="form-label">Akhir</label>
                        <input type="date" class="form-control" id="inputTglAkhir" name="akhir" value="{{$akhir}}">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="inputStatus" class="form-label">Status</label>
                        <select class="form-control" id="inputStatus" name="status">
                            <option value="pending" {{$status == 'pending' ? 'selected' : ''}}>Pending</option>
                            <option value="proses" {{$status == 'proses' ? 'selected' : ''}}>Proses</option>
                            <option value="selesai" {{$status == 'selesai' ? 'selected' : ''}}>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="inputStatus" class="form-label">_</label>
                        <button class="form-control" id="inputTglAkhir" name="akhir">Filter</button>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="inputStatus" class="form-label">_</label>
                        <button class="form-control btn btn-primary" id="inputTglAkhir">Cetak</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Hari/Tanggal</th>
                        <th>Isi Pengaduan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduan as $item)
                    <tr>
                        <td>{{ $item->user->nik }}</td>
                        <td>{{ $item->user->nama }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->isi }}</td>
                        <td><span class="badge bg-{{$item->status == 'pending' ? 'danger' : ($item->status == 'proses' ? 'primary' : 'success') }}">{{$item->status}}</span></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="{{route('pengaduan.show', $item->id)}}">Lihat</a>
                            <form action="{{ route('pengaduan.delete', $item->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

</script>
@endsection
