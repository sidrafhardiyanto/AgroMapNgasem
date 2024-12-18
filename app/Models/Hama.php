<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hama extends Model
{
    use HasFactory;

    protected $table = 'hamas';

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'ID_Tanaman');
    }
}
