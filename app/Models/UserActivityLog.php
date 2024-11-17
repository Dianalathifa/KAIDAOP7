<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'nipp', 
        'name', 
        'email', 
        'role', 
        'modify_user', 
        'date_time'
    ];

    protected $dates = ['date_time'];
}
