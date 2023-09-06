<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratTugas;
use Yajra\DataTables\DataTables;
use App\Models\Instansi;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\App;

class SuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:surat_tugas-create', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $suratTugas = SuratTugas::latest()->paginate(5);
        // return view('suratTugas.index',compact('suratTugas'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        return view('suratTugas.index', compact('request'));
    }

    public function getSuratTugas(Request $request)
    {
        if ($request->ajax()) {
            $data = SuratTugas::select('*')->orderBy('tanggal_surat', 'desc');
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
                    if (auth()->check() && auth()->user()->can('surat_tugas-action')) {

                        $btn = '<div class="d-flex flex-row bd-higlight mb-3">
                    <a href="' . route('suratTugas.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('suratTugas.edit', $value->id) . '">
                            <i class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;
                </div>';
                    } else if (auth()->check() && auth()->user()->can('surat_tugas-show')) {
                        $btn = '<div class="d-flex flex-row bd-higlight mb-3">
                        <a href="' . route('suratTugas.show', $value->id) . '"
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
        return view('suratTugas.create', ['instansis' => $instansis]);
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
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'tanggal_surat' => 'required',
            'tempat_surat' => 'required',
            'isi_surat' => 'required',

        ], [
            'jenis_surat.required' => 'Jenis Surat Wajib diisi!',
            'kode_instansi.required' => 'Kode Instansi Wajib diisi!',
            'tempat_surat.required' => 'Tempat Surat Wajib diisi!',
            'tanggal_surat.required' => 'Tanggal Surat Wajib diisi!',
            'nama_pegawai.required' => 'Nama Pegawai Wajib diisi!',
            'jabatan.required' => 'Jabatan Wajib diisi!',
            'tanggal_tugas.required' => 'Penerima Tugas Wajib diisi!',
            'tempat_tugas.required' => 'Tempat Tugas Wajib diisi!',
            'isi_surat.required' => 'Isi Surat Wajib diisi!',
        ]);

        $suratTugas = new SuratTugas();
        // $suratTugas = SuratTugas::create($request->all());

        $suratTugas->jenis_surat = $request->jenis_surat;
        $suratTugas->instansis_id = $request->kode_instansi;
        $suratTugas->tempat_surat = $request->tempat_surat;
        $suratTugas->tanggal_surat = $request->tanggal_surat;
        $suratTugas->nama_pegawai = $request->nama_pegawai;
        $suratTugas->jabatan = $request->jabatan;
        $suratTugas->tanggal_tugas = $request->tanggal_tugas;
        $suratTugas->tempat_tugas = $request->tempat_tugas;
        $suratTugas->isi_surat = $request->isi_surat;
        $suratTugas->no_surat = $request->no_surat;
        $suratTugas->save();

        return redirect('suratkeluar/suratTugas')->with('success', 'Surat Berhasil di tambahkan!');
    }

    public function generateLetterNumberTugas(Request $request)
    {
        $nama_pj = Instansi::where('id', '=', $request->kode_instansi)->first();
        $nama_pj = $nama_pj->nama_pj;
        $letterNumber = SuratTugas::generateLetterNumberTugas($request);
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
        $suratTugas = SuratTugas::findOrFail($id);
        $instansi = Instansi::all();
        return view('suratTugas.show', ['suratTugas' => $suratTugas, 'instansi' => $instansi]);
    }

    public function generatePDFTugas(Request $request, $id)
    {
        // setlocale(LC_TIME, 'id_ID');
        // suratTugas->tanggal_surat
        $suratTugas = SuratTugas::find($id);
        if ($suratTugas) {
            $tanggalSurat = Carbon::parse($suratTugas->tanggal_surat)->locale(App::getLocale())->isoFormat('D MMMM Y');
            // dd($tanggalSurat);
        }

        $instansi = $suratTugas->instansis;
        $logo = 'logoinstansi/' . $instansi->logo;
        $logoData = base64_encode(file_get_contents($logo));
        $src = 'data:' . mime_content_type($logo) . ';base64' . $logoData;
        $cap_surat = 'cap_suratinstansi/' . $instansi->cap_surat;
        $capData = base64_encode(file_get_contents($cap_surat));
        $src = 'data:' . mime_content_type($cap_surat) . ';base64' . $capData;
        $tanda_tangan = 'tanda_tanganinstansi/' . $instansi->tanda_tangan;
        $tanda_tanganData = base64_encode(file_get_contents($tanda_tangan));
        $src = 'data:' . mime_content_type($tanda_tangan) . ';base64' . $tanda_tanganData;
        $pdf = PDF::loadview('suratTugas.surat_TugasPDF', ['tanggalSurat' => $tanggalSurat, 'suratTugas' => $suratTugas, 'instansi' => $instansi, 'logo' => $logo, 'cap_surat' => $cap_surat, 'tanda_tangan' => $tanda_tangan]);
        return $pdf->stream('Surat Tugas PDF.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratTugas = SuratTugas::findOrFail($id);
        $instansis = Instansi::all();
        return view('suratTugas.edit', ['suratTugas' => $suratTugas, 'instansis' => $instansis]);
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
        $suratTugas = SuratTugas::findOrFail($id);

        $suratTugas->tempat_surat = $request->tempat_surat;
        $suratTugas->tanggal_surat = $request->tanggal_surat;
        $suratTugas->nama_pegawai = $request->nama_pegawai;
        $suratTugas->jabatan = $request->jabatan;
        $suratTugas->tanggal_tugas = $request->tanggal_tugas;
        $suratTugas->tempat_tugas = $request->tempat_tugas;
        $suratTugas->isi_surat = $request->isi_surat;
        $suratTugas->save();

        return redirect('suratkeluar/suratTugas')->with('success-edit', 'Surat Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suratTugas = SuratTugas::find($id);
        $suratTugas->delete();
        return $id;
    }
}
