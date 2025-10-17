@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Kartu Keluarga</h5>
            <a href="{{ route('kk.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>No KK</th><td>{{ $kk->no_kk }}</td></tr>
                <tr><th>Nama Kepala Keluarga</th><td>{{ $kk->nama_kepala_keluarga }}</td></tr>
                <tr><th>Alamat</th><td>{{ $kk->alamat }}</td></tr>
                <tr><th>RT / RW</th><td>{{ $kk->rt }} / {{ $kk->rw }}</td></tr>
                <tr><th>Kelurahan</th><td>{{ $kk->kelurahan }}</td></tr>
                <tr><th>Kecamatan</th><td>{{ $kk->kecamatan }}</td></tr>
                <tr><th>Kabupaten</th><td>{{ $kk->kabupaten }}</td></tr>
                <tr><th>Provinsi</th><td>{{ $kk->provinsi }}</td></tr>
                <tr><th>Kode Pos</th><td>{{ $kk->kode_pos }}</td></tr>
                <tr><th>Tanggal Terbit</th><td>{{ $kk->tanggal_terbit }}</td></tr>
                <tr>
                    <th>File Scan</th>
                    <td>
                        @if($kk->file_scan)
                            <a href="{{ asset('storage/' . $kk->file_scan) }}" target="_blank">Lihat File</a>
                        @else
                            <span class="text-muted">Belum ada file</span>
                        @endif
                    </td>
                </tr>
            </table>

            <hr>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="text-primary mb-0">Anggota Keluarga</h6>
                <a href="{{ route('ktp.create', ['kk_id' => $kk->id]) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle"></i> Tambah KTP
                </a>
            </div>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Status Perkawinan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggota as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a->nama }}</td>
                            <td>{{ $a->nik }}</td>
                            <td>{{ $a->jenis_kelamin }}</td>
                            <td>{{ $a->status_perkawinan }}</td>
                            <td>
                                <a href="{{ route('ktp.show', $a->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="{{ route('ktp.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('ktp.destroy', $a->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">Belum ada anggota keluarga</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
