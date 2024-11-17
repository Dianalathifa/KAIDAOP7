<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerkCatalog extends Model
{
    use HasFactory;

    protected $table = 'merk_catalogs';
    protected $primaryKey = 'merk_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'merk_nama',
        'merk_keterangan',
    ];
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Optional: Accessor for formatted timestamps
    public function getFormattedCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d M Y');
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->updated_at)->format('d M Y');
    }
}
