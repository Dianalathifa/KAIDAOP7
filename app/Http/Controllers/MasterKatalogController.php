<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


use App\Models\Satuan;
use App\Models\Katalog;
use App\Models\Klasifikasi;
use App\Models\MerkCatalog;
use App\Models\MasukCatalog;
use App\Models\KeluarBarangCatalog;
use App\Models\MasterBarang;
use App\Models\LokasiCatalog;

class MasterKatalogController extends Controller
{
    public function index(Request $request)
    {  
     
        $satuantotal = Satuan::count();
        $totalKatalog = Katalog::count();
        $totalMasukCatalog = MasukCatalog::count();
        $totalKeluarBarang = KeluarBarangCatalog::count();
        $totalMasterBarang = MasterBarang::count();
        $totalKlasifikasi = Klasifikasi::count();
        $merktotal = MerkCatalog::count();
        $totallokasi = LokasiCatalog::count();
        $totalUnit= UnitKerja::count();

        
        return view('admin.katalog', compact( 'totalMasterBarang', 'totalMasukCatalog', 'totalKeluarBarang', 'satuantotal','totalKatalog', 'totalKlasifikasi', 'merktotal', 'totallokasi', 'totalUnit'));
    }

    }

