<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;
use App\Models\Dashboard;
use App\Models\JadwalSurat;
use App\Models\SuratPemberitahuan;
use App\Models\SuratTugas;
use App\Models\SuratDispensasi;
use App\Models\SuratUndangan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $jumlahPemberitahuan = SuratPemberitahuan::count();
        $jumlahTugas = SuratTugas::count();
        $jumlahDispensasi = SuratDispensasi::count();
        $jumlahUndangan = SuratUndangan::count();
        $currentMonth = date('m');
        $jadwal = DB::table("jadwal_surats")
            ->whereMonth('tanggal', '=', $currentMonth)
            ->get();
        return view('home', ['jadwal' => $jadwal, 'pemberitahuan' => $jumlahPemberitahuan, 'tugas' => $jumlahTugas, 'dispensasi' => $jumlahDispensasi, 'undangan' => $jumlahUndangan]);
    }

    public function getDashboard(Request $request)
    {
        if ($request->ajax()) {
            $currentMonth = date('m');
            $data = JadwalSurat::select('*')
            ->whereMonth('tanggal', '=', $currentMonth);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($value) {
                    $date = Carbon::parse($value->tanggal)->format('d-m-Y');
                    return $date;
                })
                ->make(true);
        }
    }
}
