<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    use HasFactory;

    protected $table = 'lahans';
    protected $primaryKey = 'ID_Lahan';

    protected $fillable = [
        'pemilik',
        'luas',
        'lokasi',
        'latitude',
        'longitude',
        'keterangan'
    ];

    public function tanamans()
    {
        return $this->hasMany(Tanaman::class, 'ID_Lahan');
    }
}
