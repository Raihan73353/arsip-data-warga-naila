@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Edit Akte Nikah</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('akte_nikah.update', $akte->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>No Akte</label>
                        <input type="text" name="no_akte" value="{{ old('no_akte', $akte->no_akte) }}" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Nikah</label>
                        <input type="date" name="tanggal_nikah" value="{{ old('tanggal_nikah', $akte->tanggal_nikah) }}" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tempat Nikah</label>
                        <input type="text" name="tempat_nikah" value="{{ old('tempat_nikah', $akte->tempat_nikah) }}" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Nama Penghulu</label>
                        <input type="text" name="nama_penghulu" value="{{ old('nama_penghulu', $akte->nama_penghulu) }}" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Suami</label>
                        <select name="suami_ktp_id" class="form-control" required>
                            <option value="">-- Pilih Suami --</option>
                            @foreach ($suamiList as $ktp)
                                <option value="{{ $ktp->id }}" {{ $akte->suami_ktp_id == $ktp->id ? 'selected' : '' }}>
                                    {{ $ktp->nama }} ({{ $ktp->nik }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Istri</label>
                        <select name="istri_ktp_id" class="form-control" required>
                            <option value="">-- Pilih Istri --</option>
                            @foreach ($istriList as $ktp)
                                <option value="{{ $ktp->id }}" {{ $akte->istri_ktp_id == $ktp->id ? 'selected' : '' }}>
                                    {{ $ktp->nama }} ({{ $ktp->nik }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>File Scan Akte Nikah (opsional)</label>
                        <input type="file" name="file_scan" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.webp">
                        @if ($akte->file_scan)
                            <small class="text-muted">
                                File saat ini:
                                <a href="{{ asset('storage/' . $akte->file_scan) }}" target="_blank">Lihat</a>
                            </small>
                        @endif
                    </div>
                </div>

                <div class="text-right mt-3">
                    <a href="{{ route('akte_nikah.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
