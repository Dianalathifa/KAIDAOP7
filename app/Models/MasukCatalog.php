<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasukCatalog extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model ini
    protected $table = 'masuk_catalogs';

    // Primary key yang benar
    protected $primaryKey = 'masuk_barang_id'; // Gunakan 'masuk_barang_id' sebagai primary key
    public $incrementing = true; // Mengatur agar primary key auto-increment
    protected $keyType = 'int'; // Primary key adalah integer

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'kode_masuk',
        'kode_barang',
        'barang',
        'gambar_masuk',
        'jumlah_masuk',
        'unit_id',
    ];

    // Aktifkan timestamps jika kolom 'created_at' dan 'updated_at' ada di tabel
    public $timestamps = true; // Pastikan timestamps diaktifkan

    /**
     * Relasi ke model MasterBarang
     * Menghubungkan data masuk_catalogs dengan master_barang berdasarkan 'kode_barang'
     */
    public function masterBarang()
    {
        return $this->belongsTo(MasterBarang::class, 'kode_barang', 'kode_barang');
    }

    /**
     * Relasi ke model Katalog
     * Menghubungkan data masuk_catalogs dengan katalog berdasarkan 'kode_barang'
     */
    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'kode_barang', 'kode_barang');
    }

    /**
     * Relasi ke model UnitKerja
     * Menghubungkan data masuk_catalogs dengan unit_kerja berdasarkan 'unit_id'
     */
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_id', 'id');
    }
}
