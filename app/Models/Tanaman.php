<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tanaman extends Model
{
    use HasFactory;

    protected $table = 'tanamans';
    protected $primaryKey = 'ID_Tanaman';

    protected $fillable = [
        'ID_Lahan',
        'Jenis_Tanaman',
        'Varietas',
        'Tanggal_Penanaman',
        'Perkiraan_Panen',
        'Status',
        'Catatan'
    ];

    protected $dates = [
        'Tanggal_Penanaman',
        'Perkiraan_Panen',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'Tanggal_Penanaman' => 'date',
        'Perkiraan_Panen' => 'date'
    ];

    public function lahan()
    {
        return $this->belongsTo(Lahan::class, 'ID_Lahan', 'ID_Lahan');
    }

    public function hamas()
    {
        return $this->hasMany(HamaPenyakit::class, 'ID_Tanaman', 'ID_Tanaman');
    }

    protected function tanggalPenanaman(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? \Carbon\Carbon::parse($value) : null,
        );
    }

    protected function perkiraanPanen(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? \Carbon\Carbon::parse($value) : null,
        );
    }
}
