<?php

namespace App\Http\Controllers;

use App\Models\Ktp;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KtpController extends Controller
{
    public function create(Request $request)
    {

        // Ambil ID kartu keluarga dari parameter URL
        $kartu_keluarga_id = $request->get('kk_id');
        // $data = KartuKeluarga::with([ 'kepalaKeluarga','simamak'])->first();
        $kk = KartuKeluarga::findOrFail($kartu_keluarga_id);

        return view('ktp.create', compact('kk'));
    }
    public function store(Request $request)
    {
        $kk = KartuKeluarga::findOrFail($request->kartu_keluarga_id);

        $validated = $request->validate([
            'nik' => 'required|unique:ktps,nik|max:20',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|string|max:3',
            'alamat' => 'nullable|string',
            'agama' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'berlaku_hingga' => 'nullable',
            'file_scan' => 'nullable|file|mimes:pdf,webp,jpg,jpeg,png|max:20480',
        ]);

        if ($request->hasFile('file_scan')) {
            $validated['file_scan'] = $request->file('file_scan')->store('arsip/ktp', 'public');
        }

        $validated['kartu_keluarga_id'] = $kk->id;

        $ktp = Ktp::create([
            'kartu_keluarga_id' => $validated['kartu_keluarga_id'],
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' =>  $validated['jenis_kelamin'],
            'golongan_darah' => $validated['golongan_darah'],
            'alamat' => $kk->alamat,
            'rt' => $kk->rt,
            'rw' => $kk->rw,
            'kelurahan' => $kk->kelurahan,
            'kecamatan' => $kk->kecamatan,
            'kabupaten' => $kk->kabupaten,
            'provinsi' => $kk->provinsi,
            'agama' => $validated['agama'],
            'status' => $validated['status'],
            'pekerjaan' => $validated['pekerjaan'],
            'kewarganegaraan' => $validated['kewarganegaraan'],
            'nama_ayah' => $validated['nama_ayah'],
            'nama_ibu' => $validated['nama_ibu'],
            'berlaku_hingga' => $validated['berlaku_hingga'],
            'file_scan' => $validated['file_scan'] ?? null,
        ]);

        if ($validated['status'] == 'Kepala Keluarga') {
            $kk->update([
                'kepala_keluarga_id' => $ktp->id,
                'alamat' => $validated['alamat'],
                'rt' => $kk->rt,
                'rw' => $kk->rw,
                'kelurahan' => $kk->kelurahan,
                'kecamatan' => $kk->kecamatan,
                'kabupaten' => $kk->kabupaten,
                'provinsi' => $kk->provinsi,
            ]);
        } else {
            if ($validated['status'] == 'Isteri') {
                $kk->update([
                    'isteri_id' => $ktp->id,
                    'alamat' => $validated['alamat'],
                    'rt' => $kk->rt,
                    'rw' => $kk->rw,
                    'kelurahan' => $kk->kelurahan,
                    'kecamatan' => $kk->kecamatan,
                    'kabupaten' => $kk->kabupaten,
                    'provinsi' => $kk->provinsi,
                ]);
            }
        }



        return redirect()->route('kk.show', $kk->id)->with('success', 'Data KTP berhasil ditambahkan.');
    }


    /**
     * Update data KTP (juga dari halaman detail KK)
     */
    public function edit($id)
    {
        $ktp = ktp::findOrFail($id);
        return view('ktp.edit', compact('ktp'));
    }
    public function update(Request $request, $id)
    {
        $kk = KartuKeluarga::findOrFail($request->kartu_keluarga_id);
        $ktp = Ktp::findOrFail($id);
        $validated = $request->validate([
            'nik' => 'required|max:20|unique:ktps,nik,' . $ktp->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|string|max:3',
            'alamat' => 'nullable|string',
            'agama' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'berlaku_hingga' => 'nullable',
            'file_scan' => 'nullable|file|mimes:pdf,webp,jpg,jpeg,png|max:20480',
        ]);

        if ($request->hasFile('file_scan')) {
            // hapus file lama
            if ($ktp->file_scan && Storage::disk('public')->exists($ktp->file_scan)) {
                Storage::disk('public')->delete($ktp->file_scan);
            }
            $validated['file_scan'] = $request->file('file_scan')->store('ktp_scans', 'public');
        }

        $ktp->update([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' =>  $validated['jenis_kelamin'],
            'golongan_darah' => $validated['golongan_darah'],
            'alamat' => $kk->alamat,
            'rt' => $kk->rt,
            'rw' => $kk->rw,
            'kelurahan' => $kk->kelurahan,
            'kecamatan' => $kk->kecamatan,
            'kabupaten' => $kk->kabupaten,
            'provinsi' => $kk->provinsi,
            'agama' => $validated['agama'],
            'status' => $validated['status'],
            'pekerjaan' => $validated['pekerjaan'],
            'kewarganegaraan' => $validated['kewarganegaraan'],
            'nama_ayah' => $validated['nama_ayah'],
            'nama_ibu' => $validated['nama_ibu'],
            'berlaku_hingga' => $validated['berlaku_hingga'],
            'file_scan' => $validated['file_scan'] ?? $ktp->file_scan,
        ]);
        if ($validated['status'] == 'Kepala Keluarga') {
            $kk->update([
                'kepala_keluarga_id' => $ktp->id,
                'alamat' => $validated['alamat'],
                'rt' => $kk->rt,
                'rw' => $kk->rw,
                'kelurahan' => $kk->kelurahan,
                'kecamatan' => $kk->kecamatan,
                'kabupaten' => $kk->kabupaten,
                'provinsi' => $kk->provinsi,
            ]);
        } else {
            if ($validated['status'] == 'Isteri') {
                $kk->update([
                    'isteri_id' => $ktp->id,
                    'alamat' => $validated['alamat'],
                    'rt' => $kk->rt,
                    'rw' => $kk->rw,
                    'kelurahan' => $kk->kelurahan,
                    'kecamatan' => $kk->kecamatan,
                    'kabupaten' => $kk->kabupaten,
                    'provinsi' => $kk->provinsi,
                ]);
            }
        }

        return redirect()->route('kk.show', $ktp->kartu_keluarga_id)->with('success', 'Data KTP berhasil diperbarui.');
    }

    /**
     * Hapus data KTP (dari halaman KK)
     */
    public function destroy($id)
    {
        $ktp = Ktp::findOrFail($id);

        if ($ktp->file_scan && Storage::disk('public')->exists($ktp->file_scan)) {
            Storage::disk('public')->delete($ktp->file_scan);
        }

        $kk_id = $ktp->kartu_keluarga_id;
        $ktp->delete();

        return redirect()->route('kk.show', $kk_id)->with('success', 'Data KTP berhasil dihapus.');
    }
    public function show($id)
    {
        $ktp = Ktp::with('kartuKeluarga')->findOrFail($id);
        return view('ktp.show', compact('ktp'));
    }
}
