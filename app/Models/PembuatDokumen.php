<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembuatDokumen extends Model
{
    use HasFactory;

    protected $table = 'pembuat_dokumen';

    protected $fillable = [
        'NIPP',
        'nama',
        'jabatan',
        
        
    ];
}
