@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Edit Data KTP</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('ktp.update', $ktp->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <input type="hidden" name="kartu_keluarga_id" value="{{ $ktp->kartu_keluarga_id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" value="{{ $ktp->nik }}" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="{{ $ktp->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $ktp->tempat_lahir }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $ktp->tanggal_lahir }}">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="Laki-laki" {{ $ktp->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $ktp->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <input type="text" name="golongan_darah" class="form-control" value="{{ $ktp->golongan_darah }}">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2">{{ $ktp->alamat }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" name="agama" class="form-control" value="{{ $ktp->agama }}">
                        </div>
                        <div class="form-group">
                            <label>Status Perkawinan</label>
                            <select name="status_perkawinan" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="Belum Kawin" {{ $ktp->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ $ktp->status_perkawinan == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ $ktp->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ $ktp->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" value="{{ $ktp->pekerjaan }}">
                        </div>
                        <div class="form-group">
                            <label>Kewarganegaraan</label>
                            <input type="text" name="kewarganegaraan" class="form-control" value="{{ $ktp->kewarganegaraan }}">
                        </div>
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" value="{{ $ktp->nama_ayah }}">
                        </div>
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" value="{{ $ktp->nama_ibu }}">
                        </div>
                        <div class="form-group">
                            <label>Berlaku Hingga</label>
                            <input type="date" name="berlaku_hingga" class="form-control" value="{{ $ktp->berlaku_hingga }}">
                        </div>
                        <div class="form-group">
                            <label>File Scan KTP</label>
                            <input type="file" name="file_scan" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.webp">
                            @if ($ktp->file_scan)
                                <p class="mt-2">
                                    File saat ini: <a href="{{ asset('storage/' . $ktp->file_scan) }}" target="_blank">Lihat File</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('kk.show', $ktp->kartu_keluarga_id) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
