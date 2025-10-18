<?php

namespace App\Http\Controllers;
use App\Models\KartuKeluarga;
use App\Models\AkteNikah;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index(Request $request)
    {
        // Ambil semua KK dengan relasi kepala keluarga & istri
        $dataKK = KartuKeluarga::with(['kepalaKeluarga', 'isteri', 'anggotas'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data akte nikah (biar bisa lihat pasangan nikah)
        $dataAkte = AkteNikah::with(['suami', 'isteri'])->get();

        return view('laporan.index', compact('dataKK', 'dataAkte'));
    }
}
