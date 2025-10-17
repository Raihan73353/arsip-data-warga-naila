<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Ktp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = KartuKeluarga::latest()->paginate(10);
        $data = KartuKeluarga::with(['anggotas', 'kepalaKeluarga'])->latest()->paginate(10);

        return view('kk.index', compact('data'));
        // $kepalaKeluarga = Ktp::where('id', $data->kepala_keluarga_id)->first();
    }

    /**
     * Form tambah KK baru
     */
    public function create()
    {
        return view('kk.create');
    }

    /**
     * Simpan KK baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|string|unique:kartu_keluargas,no_kk',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'tanggal_terbit' => 'nullable|date',
            'file_scan' => 'nullable|file|mimes:pdf,webp,jpg,jpeg,png|max:20480',
        ]);

        $data = $request->only([
            'no_kk',
            'alamat',
            'rt',
            'rw',
            'kelurahan',
            'kecamatan',
            'kabupaten',
            'provinsi',
            'kode_pos',
            'tanggal_terbit',
        ]);

        // Simpan file jika diupload
        if ($request->hasFile('file_scan')) {
            $data['file_scan'] = $request->file('file_scan')->store('arsip/kk', 'public');
        }
        KartuKeluarga::create($data);

        return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil ditambahkan.');
    }


    /**
     * Lihat detail satu KK + daftar anggota KTP
     */
    public function show($id)
    {
        $kk = KartuKeluarga::findOrFail($id);
        $kepalaKeluarga = Ktp::where('id', $kk->kepala_keluarga_id)->first();
        $anggota = Ktp::where('kartu_keluarga_id', $kk->id)->get();

        return view('kk.show', compact('kk', 'anggota', 'kepalaKeluarga'));
    }

    /**
     * Form edit KK
     */
    public function edit($id)
    {
        $kk = KartuKeluarga::findOrFail($id);
        return view('kk.edit', compact('kk'));
    }

    /**
     * Update data KK
     */

    public function update(Request $request, $id)
    {
        $kk = KartuKeluarga::findOrFail($id);

        $request->validate([

            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'tanggal_terbit' => 'nullable|date',
            'file_scan' => 'nullable|file|mimes:pdf,webp,jpg,jpeg,png|max:20480',
        ]);
        $data = $request->only([
            'no_kk',
            'alamat',
            'rt',
            'rw',
            'kelurahan',
            'kecamatan',
            'kabupaten',
            'provinsi',
            'kode_pos',
            'tanggal_terbit',
        ]);

        // Jika ada file baru, hapus file lama dan simpan file baru
        if ($request->hasFile('file_scan')) {
            if ($kk->file_scan && Storage::disk('public')->exists($kk->file_scan)) {
                Storage::disk('public')->delete($kk->file_scan);
            }
            $data['file_scan'] = $request->file('file_scan')->store('arsip/kk', 'public');
        }

        $kk->update($data);

        return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil diperbarui.');
    }


    /**
     * Hapus KK
     */
    public function destroy($id)
    {
        $kk = KartuKeluarga::findOrFail($id);

        try {
            // Hapus file scan dari storage kalau ada
            if ($kk->file_scan && Storage::disk('public')->exists($kk->file_scan)) {
                Storage::disk('public')->delete($kk->file_scan);
            }

            // Hapus data dari database
            $kk->delete();

            return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kk.index')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
