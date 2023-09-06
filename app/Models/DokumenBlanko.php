<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenBlanko extends Model
{
    use HasFactory;

    protected $table = 'dokumen_blankos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'nama_dok',
        'file_doct',
    ];

    protected $hidden = [];
}
