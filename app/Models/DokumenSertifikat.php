<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenSertifikat extends Model
{
    use HasFactory;

    protected $table = 'dokumen_sertifikats';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'nama_dok',
        'file_dok',
    ];

    protected $hidden = [];
}
