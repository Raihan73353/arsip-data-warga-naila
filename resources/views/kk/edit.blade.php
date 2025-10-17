@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Edit Kartu Keluarga</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('kk.update', $kk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No KK</label>
                            <input type="text" name="no_kk" class="form-control" value="{{ $kk->no_kk }}" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Kepala Keluarga</label>
                            <input type="text" name="nama_kepala_keluarga" class="form-control" value="{{ $kk->nama_kepala_keluarga }}" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ $kk->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>RT</label>
                            <input type="text" name="rt" class="form-control" value="{{ $kk->rt }}">
                        </div>
                        <div class="form-group">
                            <label>RW</label>
                            <input type="text" name="rw" class="form-control" value="{{ $kk->rw }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control" value="{{ $kk->kelurahan }}">
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="{{ $kk->kecamatan }}">
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" value="{{ $kk->kabupaten }}">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" value="{{ $kk->provinsi }}">
                        </div>
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control" value="{{ $kk->kode_pos }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Terbit</label>
                            <input type="date" name="tanggal_terbit" class="form-control" value="{{ $kk->tanggal_terbit }}">
                        </div>
                        <div class="form-group">
                            <label>File Scan KK (opsional)</label>
                            <input type="file" name="file_scan" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.webp">
                            @if ($kk->file_scan)
                                <p class="mt-2">
                                    File saat ini: <a href="{{ asset('storage/' . $kk->file_scan) }}" target="_blank">Lihat File</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('kk.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
