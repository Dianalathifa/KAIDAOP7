<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluarBarangCatalog extends Model
{
    use HasFactory;

    protected $table = 'keluar_barang_catalogs';

    protected $fillable = [
        'kode_keluar',
        'kode_barang',
        'nama_barang',
        'jumlah_keluar',
        'unit_id',
    ];

    public $timestamps = true;

    public function masterBarang()
    {
        return $this->belongsTo(MasterBarang::class, 'kode_barang', 'kode_barang');
    }

    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'kode_barang', 'kode_barang');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_id', 'id');
    }
}
