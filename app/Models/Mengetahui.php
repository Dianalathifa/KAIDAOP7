<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mengetahui extends Model
{
    use HasFactory;
    protected $table = 'mengetahui';

    protected $fillable = [
        'NIPP',
        'nama',
        'jabatan',
        
        
    ];
}
