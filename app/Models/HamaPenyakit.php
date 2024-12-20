<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HamaPenyakit extends Model
{
    use HasFactory;

    protected $table = 'hamas';
    protected $primaryKey = 'ID_Hama';

    protected $fillable = [
        'ID_Tanaman',
        'jenis',
        'nama',
        'tanggal_laporan',
        'tingkat_serangan',
        'status',
        'gejala',
        'penanganan',
        'foto'
    ];

    protected $dates = [
        'tanggal_laporan',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tanggal_laporan' => 'date'
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'ID_Tanaman', 'ID_Tanaman');
    }
}
