<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instansi;
use Carbon\Carbon;

class SuratDispensasi extends Model
{
    use HasFactory;

    protected $table = 'surat_dispensasis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'jenis_surat',
        'instansis_id',
        'tempat_surat',
        'tanggal_surat',
        'no_surat',
        'nama_siswa',
        'asal_mdta',
        'tanggal_dispensasi',
        'tempat_dispensasi',
        'isi_surat',
    ];

    protected $hidden = [];

    public function instansis()
    {
        return $this->belongsTo(Instansi::class,
        'instansis_id',
        'id'
    );
    }

    static function generateLetterNumberDispensasi($request) {
        // dd($request->kode_instansi);
        $number = self::where('jenis_surat', $request->jenis_surat)->where('instansis_id', $request->kode_instansi)->count()+1;
        // $number = self::where('instansis_id', $request->kode_instansi)->count()+1;
        $instansis_id = Instansi::where('id', '=', $request->kode_instansi)->first();
        $instansis_id = $instansis_id->kode_instansi;
        // dd($instansis_id);
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        
        return "${number}/${instansis_id}/${month}/${year}";
    }
}
