<?php

namespace App\Http\Controllers;

use App\Models\AkteNikah;
use App\Models\Ktp;
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
            ->orderBy('nama')
            ->get();

        $istriList = Ktp::where('jenis_kelamin', 'Perempuan')
            ->orderBy('nama')
            ->get();
        return view('akte_nikah.create', compact('suamiList', 'istriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'suami_ktp_id' => 'required|different:istri_ktp_id',
            'istri_ktp_id' => 'required|different:suami_ktp_id',
            'no_akte' => 'required|unique:akte_nikahs,no_akte|max:100',
            'tanggal_nikah' => 'required|date',
            'tempat_nikah' => 'nullable|string|max:255',
            'nama_penghulu' => 'nullable|string|max:255',
            'file_scan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
        ]);

        if ($request->hasFile('file_scan')) {
            $validated['file_scan'] = $request->file('file_scan')->store('arsip/akte_nikah', 'public');
        }

        AkteNikah::create($validated);
        Ktp::where('id', $validated['suami_ktp_id'])->update(['status_perkawinan' => 'Menikah']);
        Ktp::where('id', $validated['istri_ktp_id'])->update(['status_perkawinan' => 'Menikah']);


        return redirect()->route('akte_nikah.index')->with('success', 'Akte Nikah berhasil ditambahkan.');
    }

    public function show($id)
    {
        $akte = AkteNikah::with(['suami', 'istri'])->findOrFail($id);
        return view('akte_nikah.show', compact('akte'));
    }

    public function edit($id)
    {
        $akte = AkteNikah::findOrFail($id);
        // Ambil KTP laki-laki & perempuan terpisah
        $suamiList = Ktp::where('jenis_kelamin', 'Laki-laki')
            ->orderBy('nama')
            ->get();

        $istriList = Ktp::where('jenis_kelamin', 'Perempuan')
            ->orderBy('nama')
            ->get();
        return view('akte_nikah.edit', compact('akte', 'suamiList', 'istriList'));
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
            'file_scan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
        ]);

        if ($request->hasFile('file_scan')) {
            if ($akte->file_scan && Storage::disk('public')->exists($akte->file_scan)) {
                Storage::disk('public')->delete($akte->file_scan);
            }
            $validated['file_scan'] = $request->file('file_scan')->store('arsip/akte_nikah', 'public');
        }

        $akte->update($validated);
        Ktp::where('id', $validated['suami_ktp_id'])->update(['status_perkawinan' => 'Menikah']);
        Ktp::where('id', $validated['istri_ktp_id'])->update(['status_perkawinan' => 'Menikah']);


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
