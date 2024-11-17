<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menyetujui extends Model
{
    use HasFactory;
    protected $table = 'menyetujui';

    protected $fillable = [
        'NIPP',
        'nama',
        'jabatan',
        
        
    ];
}
