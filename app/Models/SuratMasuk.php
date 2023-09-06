<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instansi;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuks';

    protected $primaryKey = 'id';

    protected $fillable = [
        'status',
        'jenis_surat',
        'instansis_id',
        'tanggal',
        'no_surat',
        'asal_surat',
        'perihal',
        'pnrm_surat',
        'nmr_registrasi',
        'file_surat',
        'role_code',
    ];

    protected $hidden = [];

    public function instansis()
    {
        return $this->belongsTo(Instansi::class,
        'instansis_id',
        'id'
    );
    }

    static function registrationNumber($request) {
        // dd($request);
        $registrationNumber = self::where('jenis_surat', $request->jenis_surat)->where('instansis_id', $request->instansi)->count()+1;
        return $registrationNumber;
    }

}
