<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyuluhPetaniLapangan extends Model
{
    use HasFactory;

    protected $table = 'ppls';
    protected $primaryKey = 'id_ppl';

    protected $fillable = [
        'Nama',
        'Email',
        'Password',
        'no_telepon'
    ];

}
