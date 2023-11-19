@extends('templates.index')

@section('style')
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection

@section('title', 'Admin')
@section('subtitle', 'Daftar Admin')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-end mb-3">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAdmin">Tambah</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.create') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="inputNama" class="form-label">Nama Lengkap<sup class="text-danger">*</sup> </label>
                                <input type="text" class="form-control" id="inputNama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputLevel" class="form-label">Level<sup class="text-danger">*</sup> </label>
                                <select class="form-control" id="inputLevel" name="level" required>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inputNoTelp" class="form-label">No. Telp<sup class="text-danger">*</sup> </label>
                                <input type="tel" class="form-control" id="inputNoTelp" name="no_telp" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputAlamat" class="form-label">Alamat<sup class="text-danger">*</sup> </label>
                                <textarea class="form-control" id="inputAlamat" name="alamat" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="inputUsername" class="form-label">Username<sup class="text-danger">*</sup> </label>
                                <input type="text" class="form-control" id="inputUsername" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label">Password<sup class="text-danger">*</sup> </label>
                                <input type="password" class="form-control" id="inputPassword" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email<sup class="text-danger">*</sup> </label>
                                <input type="email" class="form-control" id="inputEmail" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Jabatan</th>
                        <th>No. Telp</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admin as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->level }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ubahAdmin{{ $item->id }}">Ubah</button>
                            <form action="{{ route('admin.delete', $item->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="ubahAdmin{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.update', $item->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="inputNama" class="form-label">Nama Lengkap<sup class="text-danger">*</sup> </label>
                                            <input type="text" class="form-control" id="inputNama" name="nama" value="{{ $item->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputLevel" class="form-label">Level<sup class="text-danger">*</sup> </label>
                                            <select class="form-control" id="inputLevel" name="level" required>
                                                <option value="admin" {{ $item->level == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="petugas" {{ $item->level == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputNoTelp" class="form-label">No. Telp<sup class="text-danger">*</sup> </label>
                                            <input type="tel" class="form-control" id="inputNoTelp" name="no_telp" value="{{ $item->no_telp }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputAlamat" class="form-label">Alamat<sup class="text-danger">*</sup> </label>
                                            <textarea class="form-control" id="inputAlamat" name="alamat" required>{{ $item->alamat }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputUsername" class="form-label">Username<sup class="text-danger">*</sup> </label>
                                            <input type="text" class="form-control" id="inputUsername" name="username" value="{{ $item->username }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputPassword" class="form-label">Password<sup class="text-danger">*</sup> </label>
                                            <input type="password" class="form-control" id="inputPassword" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputEmail" class="form-label">Email<sup class="text-danger">*</sup> </label>
                                            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $item->email }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
