@extends('template_admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail KTP</h5>
            <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th style="width: 25%">NIK</th>
                    <td>{{ $ktp->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $ktp->nama }}</td>
                </tr>
                <tr>
                    <th>Tempat / Tanggal Lahir</th>
                    <td>{{ $ktp->tempat_lahir ?? '-' }}, {{ $ktp->tanggal_lahir ? \Carbon\Carbon::parse($ktp->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $ktp->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Golongan Darah</th>
                    <td>{{ $ktp->golongan_darah ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $ktp->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $ktp->agama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $ktp->status ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $ktp->pekerjaan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kewarganegaraan</th>
                    <td>{{ $ktp->kewarganegaraan }}</td>
                </tr>
                <tr>
                    <th>Nama Ayah</th>
                    <td>{{ $ktp->nama_ayah ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Ibu</th>
                    <td>{{ $ktp->nama_ibu ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Berlaku Hingga</th>
                    <td>{{ $ktp->berlaku_hingga ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nomor Kartu Keluarga</th>
                    <td>{{ $ktp->kartuKeluarga->no_kk ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Scan KTP</th>
                    <td>
                        @if ($ktp->file_scan)
                            <a href="{{ asset('storage/' . $ktp->file_scan) }}" target="_blank" class="btn btn-sm btn-info">Lihat File</a>
                        @else
                            <span class="text-muted">Belum ada file</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
