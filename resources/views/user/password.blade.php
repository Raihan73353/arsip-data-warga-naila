@extends('template_admin.layout')

@section('head')
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
<style>
    .card {
        max-width: 500px;
        margin: 80px auto;
        border-radius: 12px;
    }
    .btn-save {
        background-color: #4e73df;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 16px;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="container">

    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h6 class="m-0 font-weight-bold">Ubah Password</h6>
        </div>
        <div class="card-body">

            {{-- ✅ Notifikasi sukses --}}
            {{-- @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif --}}

            {{-- ⚠️ Notifikasi error --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan:
                    <ul class="mt-2 mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.password.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Password Lama</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn-save mt-3">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>

        </div>
    </div>

</div>

{{-- ✨ Hilangkan alert otomatis --}}
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(a => {
            a.classList.remove('show');
            a.classList.add('fade');
        });
    }, 4000);
</script>
@endsection
