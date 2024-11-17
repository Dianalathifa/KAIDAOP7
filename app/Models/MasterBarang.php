<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    use HasFactory;
    
    protected $table = 'master_catalogs';
    protected $primaryKey = 'master_barang_id';
    public $incrementing = true;
    protected $keyType = 'int';
    
    // Mengubah nama kolom sesuai dengan perubahan pada database
    protected $fillable = [
        'kode_barang', 
        'nama_barang', 
        'barang_masuk', // Ubah dari jumlah_masuk
        'barang_keluar', // Ubah dari jumlah_keluar
        'total_stok',
        'id_katalog', // Tambahkan id_katalog

    ];

    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'id_katalog'); // Menghubungkan dengan model Katalog
    }
    public function keluarBarangCatalogs()
    {
        return $this->hasMany(KeluarBarangCatalog::class, 'kode_barang', 'kode_barang');
    }
}
