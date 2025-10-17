<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\Ktp;
use App\Models\AkteNikah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkteNikahController extends Controller
{
    public function index()
    {
        $data = AkteNikah::with(['suami', 'istri'])->latest()->get();
        return view('akte_nikah.index', compact('data'));
    }

    public function create()
    {
        $suamiList = Ktp::where('jenis_kelamin', 'Laki-laki')
            ->where('status',  'Anak')
            ->orderBy('nama')
            ->get();


        $istriList = Ktp::where('jenis_kelamin', 'Perempuan')
            ->where('status', 'Anak')
            ->whereNotIn('kartu_keluarga_id', $suamiList->pluck('kartu_keluarga_id'))
            ->orderBy('nama')
            ->get();

        return view('akte_nikah.create', compact('suamiList', 'istriList'));
    }

    public function store(Request $request)
    {
        $alamat = ktp::where('id', $request->suami_ktp_id)->get()->first();
        $validated = $request->validate([
            'suami_ktp_id' => 'required|different:istri_ktp_id',
            'istri_ktp_id' => 'required|different:suami_ktp_id',
            'no_akte' => 'required|unique:akte_nikahs,no_akte|max:100',
            'tanggal_nikah' => 'required|date',
            'tempat_nikah' => 'nullable|string|max:255',
            'nama_penghulu' => 'nullable|string|max:255',
            'file_scan' => 'nullable|file|mimes:pdf,webp,jpg,jpeg,png|max:20480',
        ]);

        if ($request->hasFile('file_scan')) {
            $validated['file_scan'] = $request->file('file_scan')->store('arsip/akte_nikah', 'public');
        }

        // AkteNikah::create($validated);

        // Ktp::where('id', $validated['suami_ktp_id'])->update(['status_perkawinan' => 'Menikah']);
        // Ktp::where('id', $validated['istri_ktp_id'])->update(['status_perkawinan' => 'Menikah']);
        $akte = AkteNikah::create($validated);

        // Ambil data KTP suami & istri
        $kk = KartuKeluarga::create([
            'no_kk' => KartuKeluarga::generateNoKK(),
            'kepala_keluarga_id' => $request->suami_ktp_id,
            'isteri_id' => $request->istri_ktp_id,
            'alamat' => $alamat->alamat,
            'rt' => $alamat->rt,
            'rw' => $alamat->rw,
            'kelurahan' => $alamat->kelurahan,
            'kecamatan' => $alamat->kecamatan,
            'kabupaten' => $alamat->kabupaten,
            'provinsi' => $alamat->provinsi,
            'tanggal_terbit' => now(),
        ]);

        // Update status KTP
        Ktp::where('id', $request->suami_ktp_id)->update([
            'status' => 'Kepala Keluarga',
            'kartu_keluarga_id' => $kk->id,
        ]);

        Ktp::where('id', $request->istri_ktp_id)->update([
            'status' => 'Isteri',
            'kartu_keluarga_id' => $kk->id,
        ]);


        return redirect()->route('akte_nikah.index')->with('success', 'Akte Nikah berhasil ditambahkan.');
    }

    public function show($id)
    {
        $akte = AkteNikah::with(['suami', 'istri'])->findOrFail($id);
        return view('akte_nikah.show', compact('akte'));
    }

    public function edit($id)
    {

        $akte = AkteNikah::with(['suami', 'istri'])->findOrFail($id);


        return view('akte_nikah.edit', compact('akte'));
    }

    public function update(Request $request, $id)
    {
        $akte = AkteNikah::findOrFail($id);

        $validated = $request->validate([
            'suami_ktp_id' => 'required|different:istri_ktp_id',
            'istri_ktp_id' => 'required|different:suami_ktp_id',
            'no_akte' => 'required|max:100|unique:akte_nikahs,no_akte,' . $akte->id,
            'tanggal_nikah' => 'required|date',
            'tempat_nikah' => 'nullable|string|max:255',
            'nama_penghulu' => 'nullable|string|max:255',
            'file_scan' => 'nullable|file|mimes:pdf,webp,jpg,jpeg,png|max:20480',
        ]);

        if ($request->hasFile('file_scan')) {
            if ($akte->file_scan && Storage::disk('public')->exists($akte->file_scan)) {
                Storage::disk('public')->delete($akte->file_scan);
            }
            $validated['file_scan'] = $request->file('file_scan')->store('arsip/akte_nikah', 'public');
        }

        $akte->update($validated);
        Ktp::where('id', $request->suami_ktp_id)->update([
            'status' => 'Kepala Keluarga',
        ]);

        Ktp::where('id', $request->istri_ktp_id)->update([
            'status' => 'Isteri',
        ]);

        return redirect()->route('akte_nikah.index')->with('success', 'Akte Nikah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $akte = AkteNikah::findOrFail($id);

        if ($akte->file_scan && Storage::disk('public')->exists($akte->file_scan)) {
            Storage::disk('public')->delete($akte->file_scan);
        }

        $akte->delete();

        return redirect()->route('akte_nikah.index')->with('success', 'Akte Nikah berhasil dihapus.');
    }
}
