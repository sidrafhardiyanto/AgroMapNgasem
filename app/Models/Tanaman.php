<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'Tanggal_Penanaman' => 'datetime',
        'Perkiraan_Panen' => 'datetime'
    ];

    public function lahan()
    {
        return $this->belongsTo(Lahan::class, 'ID_Lahan', 'ID_Lahan');
    }

    public function hamas()
    {
        return $this->hasMany(HamaPenyakit::class, 'ID_Tanaman', 'ID_Tanaman');
    }

    public function getTanggalPenanamanFormattedAttribute()
    {
        return $this->Tanggal_Penanaman ? Carbon::parse($this->Tanggal_Penanaman)->format('d/m/Y') : '-';
    }

    public function getPerkiraanPanenFormattedAttribute()
    {
        return $this->Perkiraan_Panen ? Carbon::parse($this->Perkiraan_Panen)->format('d/m/Y') : '-';
    }

    public function getUsiaTanamanAttribute()
    {
        return $this->Tanggal_Penanaman ? Carbon::parse($this->Tanggal_Penanaman)->diffInDays(now()) : 0;
    }

    public function getSisaHariPanenAttribute()
    {
        return $this->Perkiraan_Panen ? Carbon::parse($this->Perkiraan_Panen)->diffInDays(now()) : 0;
    }
}
