<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'activity_id',
        'status',
    ];
    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class,'pegawai_id');
    }
     public function activities()
    {
        return $this->belongsTo(PegawaiActivity::class,'activity_id');


    }
}
