@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tambah Anggota Keluarga </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('ktp.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kartu_keluarga_id" value="{{ $kk->id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <input type="text" name="golongan_darah" class="form-control" maxlength="3">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" name="agama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Status Dalam Keluarga</label>
                            <select name="status" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="Kepala Keluarga">Kepala Keluarga</option>
                                <option value="Isteri">Isteri</option>
                                <option value="Anak">Anak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kewarganegaraan</label>
                            <input type="text" name="kewarganegaraan" class="form-control" value="WNI">
                        </div>
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>File Scan KTP (jika ktp sudah tersedia)</label>
                            <input type="file" name="file_scan" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.webp">
                        </div>
                        <div class="form-group">
                            <label>Berlaku Hingga (abaikan jika kamu belum mempunyai ktp)</label>
                            <input type="date" name="berlaku_hingga" class="form-control" id="berlaku_hingga">

                            <div class="form-check mt-2">
                                <input type="checkbox" name="berlaku_hingga" id="seumur_hidup" value="seumur hidup" class="form-check-input">
                                <label for="seumur_hidup" class="form-check-label">Seumur Hidup</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('kk.show', $kk->id) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.getElementById('seumur_hidup').addEventListener('change', function() {
    const input = document.getElementById('berlaku_hingga');
    if (this.checked) {
        input.value = ''; // hapus tanggal
        input.disabled = true;
    } else {
        input.disabled = false;
    }
});
</script>
@endsection
