@extends('template_admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Akte Nikah</h4>
        <a href="{{ route('akte_nikah.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Akte Nikah
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>No Akte</th>
                        <th>Nama Suami</th>
                        <th>Nama Istri</th>
                        <th>Tanggal Nikah</th>
                        <th>File Scan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                        <tr class="align-middle">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->no_akte }}</td>
                            <td>{{ $item->suami->nama ?? '-' }}</td>
                            <td>{{ $item->istri->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_nikah)->format('d-m-Y') }}</td>
                            <td class="text-center">
                                @if ($item->file_scan)
                                    <a href="{{ asset('storage/' . $item->file_scan) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('akte_nikah.show', $item->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('akte_nikah.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('akte_nikah.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data Akte Nikah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
