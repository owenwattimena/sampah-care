@extends('templates.index')

@section('title', 'Dashboard')
{{-- @section('subtitle', 'Daftar Pengaduan') --}}


@section('content')
<div class="card radius-10">
    <div class="card-content">
        <div class="row row-group row-cols-1 row-cols-xl-3">
            <div class="col">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Pending</p>
                            <h4 class="mb-0 text-danger">{{ $statistik['pending'] }}</h4>
                        </div>
                        <div class="ms-auto"><i class="bx bx-plus font-35 text-danger"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 my-2" style="height:4px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                    </div>
                    <p class="mb-0 font-13">Data pengaduan status pending</p>
                </div>
            </div>
            <div class="col">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Proses</p>
                            <h4 class="mb-0 text-primary">{{ $statistik['proses'] }}</h4>
                        </div>
                        <div class="ms-auto"><i class="bx bx-bus font-35 text-primary"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 my-2" style="height:4px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                    </div>
                    <p class="mb-0 font-13">Data pengaduan diproses</p>
                </div>
            </div>
            <div class="col">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Selesai</p>
                            <h4 class="mb-0 text-success">{{ $statistik['selesai'] }}</h4>
                        </div>
                        <div class="ms-auto"><i class="bx bx-check font-35 text-success"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 my-2" style="height:4px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                    </div>
                    <p class="mb-0 font-13">Data pengaduan diselesaikan</p>
                </div>
            </div>
            {{-- <div class="col">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Customers</p>
                            <h4 class="mb-0 text-warning">8.4K</h4>
                        </div>
                        <div class="ms-auto"><i class="bx bx-group font-35 text-warning"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 my-2" style="height:4px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"></div>
                    </div>
                    <p class="mb-0 font-13">+8.4% from last week</p>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
