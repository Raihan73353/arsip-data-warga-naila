@extends('template_admin.layout')

@section('content')
<div class="container">
    <h4>Tambah Akte Nikah</h4>
    <form action="{{ route('akte_nikah.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Suami</label>
            <select name="suami_ktp_id" class="form-control" required>
                <option value="">-- Pilih Suami --</option>
                @foreach($suamiList as $ktp)
                    <option value="{{ $ktp->id }}">{{ $ktp->nama }} - {{ $ktp->nik }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Istri</label>
            <select name="istri_ktp_id" class="form-control" required>
                <option value="">-- Pilih Istri --</option>
                @foreach($istriList as $ktp)
                    <option value="{{ $ktp->id }}">{{ $ktp->nama }} - {{ $ktp->nik }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label>No Akte</label>
            <input type="text" name="no_akte" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Tanggal Nikah</label>
            <input type="date" name="tanggal_nikah" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Tempat Nikah</label>
            <input type="text" name="tempat_nikah" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label>Nama Penghulu</label>
            <input type="text" name="nama_penghulu" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label>File Scan Akte (opsional)</label>
            <input type="file" name="file_scan" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.webp">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
