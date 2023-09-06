<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratDispensasi;
use Yajra\DataTables\DataTables;
use App\Models\Instansi;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\App;

class SuratDispensasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:surat_dispensasi-create', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $suratDispensasi = SuratDispensasi::latest()->paginate(5);
        // return view('suratDispensasi.index',compact('suratDispensasi'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        return view('suratDispensasi.index', compact('request'));
    }

    public function getSuratDispensasi(Request $request)
    {
        if ($request->ajax()) {
            $data = SuratDispensasi::select('*')->orderBy('tanggal_surat', 'desc');
            $data->when($request->awal, function ($value) use ($request) {
                $value->where('tanggal_surat', '>=', $request->awal);
            });
            $data->when($request->akhir, function ($value) use ($request) {
                $value->where('tanggal_surat', '<=', $request->akhir);
            });
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal_surat', function ($value) {
                    $tanggal = Carbon::parse($value->tanggal_surat)->format('d-m-Y');
                    return $tanggal;
                })

                ->addColumn('action', function ($value) {
                    if (auth()->check() && auth()->user()->can('surat_dispensasi-action')) {

                        $btn = '<div class="d-flex flex-row bd-higlight mb-3">
                    <a href="' . route('suratDispensasi.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('suratDispensasi.edit', $value->id) . '">
                            <i class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;
                </div>';
                    } else if (auth()->check() && auth()->user()->can('surat_tugas-show')) {
                        $btn = '<div class="d-flex flex-row bd-higlight mb-3">
                    <a href="' . route('suratDispensasi.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i class="fas fa-info"></i>&nbsp;</a>&nbsp;
                </div>';
                    } else {
                        $btn = ''; // Empty string if the condition is not met
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instansis = Instansi::all();
        return view('suratDispensasi.create', ['instansis' => $instansis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'kode_instansi' => 'required',
            'tempat_surat' => 'required',
            'tanggal_surat' => 'required',
            'nama_siswa' => 'required',
            'asal_mdta' => 'required',
            'tanggal_dispensasi' => 'required',
            'tempat_dispensasi' => 'required',
            'isi_surat' => 'required',

        ], [
            'jenis_surat.required' => 'Jenis Surat Wajib diisi!',
            'kode_instansi.required' => 'Kode Instansi Wajib diisi!',
            'tempat_surat.required' => 'Tempat Surat Wajib diisi!',
            'tanggal_surat.required' => 'Tanggal Surat Wajib diisi!',
            'nama_siswa.required' => 'Nama Siswa Wajib diisi!',
            'asal_mdta.required' => 'Asal Madrasah Wajib diisi!',
            'tanggal_dispensasi.required' => 'Penerima Dispensasi Wajib diisi!',
            'tempat_dispensasi.required' => 'Tempat Dispensasi Wajib diisi!',
            'isi_surat.required' => 'Isi Surat Wajib diisi!',
        ]);

        $suratDispensasi = new SuratDispensasi();
        // $suratDispensasi = SuratDispensasi::create($request->all());

        $suratDispensasi->jenis_surat = $request->jenis_surat;
        $suratDispensasi->instansis_id = $request->kode_instansi;
        $suratDispensasi->tempat_surat = $request->tempat_surat;
        $suratDispensasi->tanggal_surat = $request->tanggal_surat;
        $suratDispensasi->nama_siswa = $request->nama_siswa;
        $suratDispensasi->asal_mdta = $request->asal_mdta;
        $suratDispensasi->tanggal_dispensasi = $request->tanggal_dispensasi;
        $suratDispensasi->tempat_dispensasi = $request->tempat_dispensasi;
        $suratDispensasi->isi_surat = $request->isi_surat;
        $suratDispensasi->no_surat = $request->no_surat;
        $suratDispensasi->save();

        return redirect('suratkeluar/suratDispensasi')->with('success', 'Surat Berhasil di tambahkan!');
    }

    public function generateLetterNumberDispensasi(Request $request)
    {
        $nama_pj = Instansi::where('id', '=', $request->kode_instansi)->first();
        $nama_pj = $nama_pj->nama_pj;
        $letterNumber = SuratDispensasi::generateLetterNumberDispensasi($request);
        return ['letterNumber' => $letterNumber, 'nama_pj' => $nama_pj];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suratDispensasi = SuratDispensasi::findOrFail($id);
        $instansi = Instansi::all();
        return view('suratDispensasi.show', ['suratDispensasi' => $suratDispensasi, 'instansi' => $instansi]);
    }

    public function generatePDFDispensasi(Request $request, $id)
    {
        // setlocale(LC_TIME, 'id_ID');
        // suratDispensasi->tanggal_surat
        $suratDispensasi = SuratDispensasi::find($id);
        if ($suratDispensasi) {
            $tanggalSurat = Carbon::parse($suratDispensasi->tanggal_surat)->locale(App::getLocale())->isoFormat('D MMMM Y');
            // dd($tanggalSurat);
        }

        $instansi = $suratDispensasi->instansis;
        $logo = 'logoinstansi/' . $instansi->logo;
        $logoData = base64_encode(file_get_contents($logo));
        $src = 'data:' . mime_content_type($logo) . ';base64' . $logoData;
        $cap_surat = 'cap_suratinstansi/' . $instansi->cap_surat;
        $capData = base64_encode(file_get_contents($cap_surat));
        $src = 'data:' . mime_content_type($cap_surat) . ';base64' . $capData;
        $tanda_tangan = 'tanda_tanganinstansi/' . $instansi->tanda_tangan;
        $tanda_tanganData = base64_encode(file_get_contents($tanda_tangan));
        $src = 'data:' . mime_content_type($tanda_tangan) . ';base64' . $tanda_tanganData;
        $pdf = PDF::loadview('suratDispensasi.surat_DispensasiPDF', ['tanggalSurat' => $tanggalSurat, 'suratDispensasi' => $suratDispensasi, 'instansi' => $instansi, 'logo' => $logo, 'cap_surat' => $cap_surat, 'tanda_tangan' => $tanda_tangan]);
        return $pdf->stream('Surat Dispensasi PDF.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratDispensasi = SuratDispensasi::findOrFail($id);
        $instansis = Instansi::all();
        // dd($suratDispensasi);
        return view('suratDispensasi.edit', ['suratDispensasi' => $suratDispensasi, 'instansis' => $instansis]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $suratDispensasi = SuratDispensasi::findOrFail($id);

        $suratDispensasi->tempat_surat = $request->tempat_surat;
        $suratDispensasi->tanggal_surat = $request->tanggal_surat;
        $suratDispensasi->nama_siswa = $request->nama_siswa;
        $suratDispensasi->asal_mdta = $request->asal_mdta;
        $suratDispensasi->tanggal_dispensasi = $request->tanggal_dispensasi;
        $suratDispensasi->tempat_dispensasi = $request->tempat_dispensasi;
        $suratDispensasi->isi_surat = $request->isi_surat;
        $suratDispensasi->save();

        return redirect('suratkeluar/suratDispensasi')->with('success-edit', 'Surat Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suratDispensasi = SuratDispensasi::find($id);
        $suratDispensasi->delete();
        return $id;
    }
}
