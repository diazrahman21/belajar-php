<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'status',
        'keterangan',
        'tanggal',
        'waktu'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i'
    ];
}
