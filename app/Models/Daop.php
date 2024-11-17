<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daop extends Model
{
    use HasFactory;

    
    protected $table = 'daop';

    protected $fillable = [
        'namadaop',
        
        
    ];

    public $timestamps = true;
}
