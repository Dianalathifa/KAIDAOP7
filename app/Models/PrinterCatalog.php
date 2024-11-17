<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterCatalog extends Model
{
    use HasFactory;

    protected $table = 'printer_catalogs';
    protected $primaryKey = 'id_printer';
    
    protected $fillable = [
        'id_printer',
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

