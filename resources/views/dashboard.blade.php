@extends('template_admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Judul Dashboard -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Arsip Warga</h1>

    <!-- Row Statistik -->
    <div class="row">
        <!-- Total KK -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Kartu Keluarga</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKK ?? '-' }}</div>
                    </div>
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Total KTP -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Warga</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKTP ?? '-' }}</div>
                    </div>
                    <i class="fas fa-id-card fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Total Akte Nikah -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Akte Nikah</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAkte ?? '-' }}</div>
                    </div>
                    <i class="fas fa-heart fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel data terbaru -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">5 Kartu Keluarga Terbaru</h6>
            <a href="{{ route('kk.index') }}" class="btn btn-light btn-sm">Lihat Semua</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No KK</th>
                            <th>Kepala Keluarga</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kkTerbaru as $kk)
                            <tr>
                                <td>{{ $kk->no_kk }}</td>
                                <td>{{ $kk->kepalaKeluarga->nama ?? '-' }}</td>
                                <td>{{ $kk->alamat }}</td>
                                <td>{{ $kk->kecamatan }}</td>
                                <td>{{ $kk->kabupaten }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data KK</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

