<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KartuKeluarga;
use App\Models\Ktp;
use App\Models\AkteNikah;
class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalKK = KartuKeluarga::count();
        $totalKTP = Ktp::count();
        $totalAkte = AkteNikah::count();

        $kkTerbaru = KartuKeluarga::with('kepalaKeluarga')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('totalKK', 'totalKTP', 'totalAkte', 'kkTerbaru'));
    }
}
