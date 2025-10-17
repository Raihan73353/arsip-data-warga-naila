@extends('template_admin.layout')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Detail Akte Nikah</h4>
        <a href="{{ route('akte_nikah.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <div class="card shadow p-3">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>No Akte</th>
                    <td>{{ $akte->no_akte }}</td>
                </tr>
                <tr>
                    <th>Tanggal Nikah</th>
                    <td>{{ \Carbon\Carbon::parse($akte->tanggal_nikah)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Tempat Nikah</th>
                    <td>{{ $akte->tempat_nikah ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Penghulu</th>
                    <td>{{ $akte->nama_penghulu ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Suami</th>
                    <td>{{ $akte->suami->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Istri</th>
                    <td>{{ $akte->istri->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>File Scan</th>
                    <td>
                        @if ($akte->file_scan)
                            <a href="{{ asset('storage/' . $akte->file_scan) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                Lihat File
                            </a>
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
