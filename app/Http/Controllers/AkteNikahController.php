<?php

namespace App\Http\Controllers;

use App\Models\AkteNikah;
use App\Models\Ktp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkteNikahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akteNikahs = AkteNikah::with(['suami', 'istri'])->get();
        return view('akte_nikah.index', compact('akteNikahs'));
    }

    public function create()
    {
        $ktps = Ktp::all();
        return view('akte_nikah.create', compact('ktps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'suami_ktp_id' => 'required|exists:ktps,id',
            'istri_ktp_id' => 'required|exists:ktps,id|different:suami_ktp_id',
            'no_akte' => 'required|unique:akte_nikahs,no_akte',
            'tanggal_nikah' => 'required|date',
            'tempat_nikah' => 'nullable|string',
            'nama_penghulu' => 'nullable|string',
            'file_scan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_scan')) {
            $data['file_scan'] = $request->file('file_scan')->store('arsip/akte_nikah', 'public');
        }

        AkteNikah::create($data);

        return redirect()->route('akte-nikah.index')->with('success', 'Data Akte Nikah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $akte = AkteNikah::findOrFail($id);
        $ktps = Ktp::all();
        return view('akte_nikah.edit', compact('akte', 'ktps'));
    }

    public function update(Request $request, $id)
    {
        $akte = AkteNikah::findOrFail($id);

        $request->validate([
            'suami_ktp_id' => 'required|exists:ktps,id',
            'istri_ktp_id' => 'required|exists:ktps,id|different:suami_ktp_id',
            'no_akte' => 'required|unique:akte_nikahs,no_akte,' . $akte->id,
            'tanggal_nikah' => 'required|date',
            'tempat_nikah' => 'nullable|string',
            'nama_penghulu' => 'nullable|string',
            'file_scan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_scan')) {
            if ($akte->file_scan && Storage::disk('public')->exists($akte->file_scan)) {
                Storage::disk('public')->delete($akte->file_scan);
            }
            $data['file_scan'] = $request->file('file_scan')->store('arsip/akte_nikah', 'public');
        }

        $akte->update($data);

        return redirect()->route('akte-nikah.index')->with('success', 'Data Akte Nikah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $akte = AkteNikah::findOrFail($id);

        if ($akte->file_scan && Storage::disk('public')->exists($akte->file_scan)) {
            Storage::disk('public')->delete($akte->file_scan);
        }

        $akte->delete();

        return redirect()->route('akte-nikah.index')->with('success', 'Data Akte Nikah berhasil dihapus.');
    }
}
