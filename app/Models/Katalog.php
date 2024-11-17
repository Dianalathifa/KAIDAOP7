<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Katalog extends Model
{
    use HasFactory;

    protected $table = 'katalogs';

    protected $fillable = [
        'klasifikasi',
        'kode_barang',
        'nama',
        'detail_spesifikasi',
        'brand',
        'type',
        'harga_asli_offline',
        'harga_asli_online',
        'harga_rab_persen',
        'harga_rab_wajar',
        'tanggal_update',
        'vendor',
        'satuan',
        'keterangan',
        'gambar_perangkat',
        'link'
    ];

    public $timestamps = true; // Jika Anda menggunakan timestamps

    // Relasi dengan Klasifikasi
    public function klasifikasiRelasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi', 'inisial');
    }

    // Relasi dengan MerkCatalog
    public function merkCatalog()
    {
        return $this->belongsTo(MerkCatalog::class, 'brand', 'merk_nama');
    }

    // Hook untuk menyimpan brand ke merk_catalogs
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($katalog) {
            // Contoh validasi sebelum menyimpan
            if (empty($katalog->kode_barang)) {
                throw new \Exception('Kode barang tidak boleh kosong.');
            }

            if ($katalog->brand) {
                MerkCatalog::firstOrCreate(['merk_nama' => $katalog->brand]);
            }
        });
    }

    // Relasi dengan MasterBarang
    public function masterBarangs()
    {
        return $this->hasMany(MasterBarang::class, 'id_katalog'); // Menghubungkan dengan model MasterBarang
    }

    // Metode untuk mendapatkan jumlah total barang
    public function totalBarang()
    {
        return $this->masterBarangs()->sum('total_stok'); // Menghitung total stok dari semua MasterBarang terkait
    }
}
