@extends('template_admin.layout')

@section('head')
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
<style>
    .custom-table th, .custom-table td {
        text-align: center;
        vertical-align: middle;
        font-weight: 500;
    }
    .custom-table th {
        background: #4e73df; /* biru header */
        color: white;
    }
    .btn-add {
        background-color: #1cc88a;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
    }
    .btn-delete {
        background-color: #e74a3b;
        color: white;
        border: none;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
    }
    .icon-btn {
        font-size: 18px;
        margin-left: 6px;
        cursor: pointer;
        color: #4e4e4e;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h5 class="m-0 font-weight-bold text-primary">Manajemen User</h5>
    </div>

    <!-- Card Utama -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h6 class="m-0 font-weight-bold">Daftar User</h6>
        </div>
        <div class="card-body">

            {{-- ✅ Notifikasi Sukses --}}
            {{-- @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}

                </div>
            @endif --}}

            {{-- ⚠️ Notifikasi Error Validasi --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan:
                    <ul class="mt-2 mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <!-- Form Tambah User -->
            <form action="{{ url('/users') }}" method="POST" class="mb-4">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required value="{{ old('name') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="email" name="email" class="form-control" placeholder="email" required value="{{ old('email') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn-add w-100">Tambah User</button>
                    </div>
                </div>
            </form>

            <!-- Tabel Daftar User -->
            <table class="table table-bordered custom-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>NAMA</th>
                        <th>email</th>
                        <th>DIBUAT</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ strtoupper($user->name) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

{{-- ✨ Script supaya alert hilang otomatis --}}
<script>
    setTimeout(() => {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(el => {
            el.classList.remove('show');
            el.classList.add('fade');
        });
    }, 4000);
</script>
@endsection
