<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablemonitorCatalog extends Model
{
    use HasFactory;

    protected $table = 'tablemonitor_catalogs';
    protected $primaryKey = 'id_tabletmonitor';
    
    protected $fillable = [
        'id_tabletmonitor',
        'nama',
        'detail_spesifikasi',
        'klasifikasi',
        'brand',
        'type',
        'harga_asli_offline',
        'harga_asli_online',
        'harga_rab_persen',
        'harga_rab_wajar',
        'tanggal_update',
        'vendor',
        'jumlah_kebutuhan',
        'jumlah_ketersediaan',
        'satuan',
        'keterangan',
        'gambar_perangkat',
        'link'
    ];

    public $timestamps = true; // Jika Anda menggunakan timestamps
}

