<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiCatalog extends Model
{
    use HasFactory;

    protected $table = 'lokasi_catalogs';
    protected $primaryKey = 'lokasi_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'lokasi_penyimpanan',
        'lokasi_deskripsi',
    ];

    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
