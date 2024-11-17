<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {  
        $katalogPerTahun = Katalog::selectRaw('YEAR(tanggal_update) as tahun, COUNT(*) as jumlah')
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->get();

    // Siapkan data untuk chart
    $tahunLabels = $katalogPerTahun->pluck('tahun');
    $katalogCounts = $katalogPerTahun->pluck('jumlah');
        $totalUsers = User::count();
        $totalKatalog = Katalog::count();
        return view('admin.dashboard', compact('totalUsers','totalKatalog','tahunLabels', 'katalogCounts'));
    }
    
}
