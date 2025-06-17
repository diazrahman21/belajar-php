<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $fillable = [
        'user_id',
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

    /**
     * Get the user that owns the presensi
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
