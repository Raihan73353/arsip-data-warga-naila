@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Data Warga</h1>

    <!-- Bagian 1: Laporan KK -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Laporan Kartu Keluarga</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No KK</th>
                        <th>Kepala Keluarga</th>
                        <th>Istri</th>
                        <th>Alamat</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Jumlah Anggota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataKK as $kk)
                        <tr>
                            <td>{{ $kk->no_kk }}</td>
                            <td>{{ $kk->kepalaKeluarga->nama ?? '-' }}</td>
                            <td>{{ $kk->isteri->nama ?? '-' }}</td>
                            <td>{{ $kk->alamat }}</td>
                            <td>{{ $kk->kecamatan }}</td>
                            <td>{{ $kk->kabupaten }}</td>
                            <td>{{ $kk->anggotas ? $kk->anggotas->count() : 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bagian 2: Laporan Akte Nikah -->
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Laporan Akte Nikah</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No Akte</th>
                        <th>Suami</th>
                        <th>Istri</th>
                        <th>Tanggal Nikah</th>
                        <th>Tempat Nikah</th>
                        <th>Nama Penghulu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataAkte as $akte)
                        <tr>
                            <td>{{ $akte->no_akte ?? '-'}}</td>
                            <td>{{ $akte->suami->nama ?? '-' }}</td>
                            <td>{{ $akte->isteri->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($akte->tanggal_nikah)->format('d-m-Y') ?? '-'}}</td>
                            <td>{{ $akte->tempat_nikah ?? '-'}}</td>
                            <td>{{ $akte->nama_penghulu ?? '-'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
