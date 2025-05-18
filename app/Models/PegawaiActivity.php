<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiActivity extends Model
{
    protected $fillable = [
        'nama_aktivitas',
        'deskripsi',
        'jam_mulai',
        'jam_selesai',
    ];
}
