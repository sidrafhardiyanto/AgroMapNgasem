<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyuluhPetaniLapangan extends Model
{
    use HasFactory;

    protected $table = 'ppls';
    protected $primaryKey = 'ID_PPL';

    protected $fillable = [
        'Nama',
        'Email',
        'Password',
        'No_Telepon'
    ];

    protected $hidden = [
        'Password'
    ];

    public function lahans()
    {
        return $this->hasMany(Lahan::class, 'ID_PPL', 'ID_PPL');
    }
}
