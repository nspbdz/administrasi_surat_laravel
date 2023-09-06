<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_instansi',
        'cabang_instansi',
        'nama_pj',
        'jabatan',
        'nip',
        'alamat',
        'nmr_telepon',
        'kode_instansi',
        'logo',
        'tanda_tangan',
        'cap_surat',
    ];

    protected $hidden = [];
}
