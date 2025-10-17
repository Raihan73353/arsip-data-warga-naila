@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Kartu Keluarga</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('kk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No KK</label>
                            <input type="text" name="no_kk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Kepala Keluarga</label>
                            <input type="text" name="nama_kepala_keluarga" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>RT</label>
                            <input type="text" name="rt" class="form-control" maxlength="5">
                        </div>
                        <div class="form-group">
                            <label>RW</label>
                            <input type="text" name="rw" class="form-control" maxlength="5">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Terbit</label>
                            <input type="date" name="tanggal_terbit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>File Scan KK (opsional)</label>
                            <input type="file" name="file_scan" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.webp">
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('kk.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
