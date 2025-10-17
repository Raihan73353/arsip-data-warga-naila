@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kartu Keluarga</h5>
            <a href="{{ route('kk.create') }}" class="btn btn-light btn-sm">+ Tambah KK</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>No KK</th>
                        <th>Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>Kecamatan</th>
                        <th>kabupaten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $kk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kk->no_kk }}</td>
                            <td>{{ $kk->kepalaKeluarga->nama ?? '-' }}</td>
                            <td>{{ $kk->alamat }}</td>
                            <td>{{ $kk->kecamatan }}</td>
                            <td>{{ $kk->kabupaten }}</td>
                            <td>
                                <a href="{{ route('kk.show', $kk->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('kk.edit', $kk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('kk.destroy', $kk->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus KK ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data Kartu Keluarga</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
