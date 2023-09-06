<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSurat extends Model
{
    use HasFactory;

    protected $table = 'jadwal_surats';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'nama_keg',
        'jenis_surat',
    ];

    protected $hidden = [];
}
