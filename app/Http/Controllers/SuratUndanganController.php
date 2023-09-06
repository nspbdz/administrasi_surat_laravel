<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratUndangan;
use Yajra\DataTables\DataTables;
use App\Models\Instansi;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


class SuratUndanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:surat_undangan-create', ['only' => ['create', 'store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $suratUndangan = SuratUndangan::latest()->paginate(5);
        // return view('suratUndangan.index',compact('suratUndangan'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        return view('suratUndangan.index', compact('request'));
    }

    public function getSuratUndangan(Request $request)
    {
        $user = Auth::user();
        $user = $user['roles'][0]['code'];
        $excludedRoles = ['dpp', 'dpc', 'dpw'];

        if ($request->ajax()) {
            if ($user == "dpp" || $user == "dpc" || $user == "dpw") {
                $data = SuratUndangan::select('*')->where("role_code", "=", $user)->orderBy('tanggal_surat', 'desc');
            } else {
                $data = SuratUndangan::select('*')
                    ->whereNotIn("role_code", $excludedRoles)->orderBy('tanggal_surat', 'desc');
            }

            // $data = SuratUndangan::select('*');
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
                    if (auth()->check() && auth()->user()->can('surat_undangan-action')) {

                        $btn = '<div class="d-flex flex-row bd-higlight mb-3">
                    <a href="' . route('suratUndangan.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('suratUndangan.edit', $value->id) . '">
                            <i class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;
                </div>';
                    } else if (auth()->check() && auth()->user()->can('surat_tugas-show')) {
                        $btn =  $btn = '<div class="d-flex flex-row bd-higlight mb-3">
                        <a href="' . route('suratUndangan.show', $value->id) . '"
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
        return view('suratUndangan.create', ['instansis' => $instansis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'jenis_surat' => 'required',
            'kode_instansi' => 'required',
            'tempat_surat' => 'required',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'pnrm_surat' => 'required',
            'alamat_surat' => 'required',
            'isi_surat' => 'required',
            'tanggal_keg' => 'required',
            'waktu_keg' => 'required',
            'tempat_keg' => 'required',
            'acara' => 'required',

        ], [
            'jenis_surat.required' => 'Jenis Surat Wajib diisi!',
            'kode_instansi.required' => 'Kode Instansi Wajib diisi!',
            'tempat_surat.required' => 'Tempat Surat Wajib diisi!',
            'tanggal_surat.required' => 'Tanggal Surat Wajib diisi!',
            'pengirim.required' => 'Pengirim Wajib diisi!',
            'perihal.required' => 'Perihal Wajib diisi!',
            'pnrm_surat.required' => 'Penerima Surat Wajib diisi!',
            'alamat_surat.required' => 'Alamat surat Wajib diisi!',
            'isi_surat.required' => 'Isi Surat Wajib diisi!',
            'tanggal_keg.required' => 'Tanggal Kegiatan Wajib diisi!',
            'waktu_keg.required' => 'Waktu Kegiatan Wajib diisi!',
            'tempat_keg.required' => 'Tempat Kegiatan Wajib diisi!',
            'acara.required' => 'Acara Wajib diisi!',
        ]);

        $suratUndangan = new SuratUndangan();
        // $suratUndangan = SuratUndangan::create($request->all());

        $suratUndangan->jenis_surat = $request->jenis_surat;
        $suratUndangan->instansis_id = $request->kode_instansi;
        $suratUndangan->tempat_surat = $request->tempat_surat;
        $suratUndangan->tanggal_surat = $request->tanggal_surat;
        $suratUndangan->pengirim = $request->pengirim;
        $suratUndangan->perihal = $request->perihal;
        $suratUndangan->pnrm_surat = $request->pnrm_surat;
        $suratUndangan->alamat_surat = $request->alamat_surat;
        $suratUndangan->isi_surat = $request->isi_surat;
        $suratUndangan->tanggal_keg = $request->tanggal_keg;
        $suratUndangan->waktu_keg = $request->waktu_keg;
        $suratUndangan->tempat_keg = $request->tempat_keg;
        $suratUndangan->acara = $request->acara;
        $suratUndangan->no_surat = $request->no_surat;
        $suratUndangan->role_code = $user['roles'][0]['code'];
        $suratUndangan->save();

        return redirect('suratkeluar/suratUndangan')->with('success', 'Surat Berhasil di tambahkan!');
    }

    public function generateLetterNumberUndangan(Request $request)
    {
        $nama_pj = Instansi::where('id', '=', $request->kode_instansi)->first();
        $nama_pj = $nama_pj->nama_pj;
        $letterNumber = SuratUndangan::generateLetterNumberUndangan($request);
        return ['letterNumber' => $letterNumber, 'nama_pj' => $nama_pj];
    }

    public function generatePDFUndangan(Request $request, $id)
    {
        // setlocale(LC_TIME, 'id_ID');
        // suratUndangan->tanggal_surat
        $suratUndangan = SuratUndangan::find($id);
        // $suratUndangan->acara = strip_tags($suratUndangan->acara);
        $suratUndangan->acara = $suratUndangan->acara;

        // Find the positions of the first opening and closing <p> tags
        $startPos = strpos($suratUndangan->acara, '<p>');
        $endPos = strpos($suratUndangan->acara, '</p>', $startPos);

        // Extract the content between the <p> tags
        $firstPTagContent = substr($suratUndangan->acara, $startPos + 3, $endPos - ($startPos + 3));

        // Use a regular expression pattern to match the first <p> tag and its content
        $pattern = '/<p>(.*?)<\/p>/';
        $firstPTagRemoved = preg_replace($pattern, '', $suratUndangan->acara, 1);

        // Concatenate the desired content with the remaining $firstPTagRemoved
        $suratUndangan->acara = $firstPTagContent . $firstPTagRemoved;

        // dd($finalOutput);


        if ($suratUndangan) {
            $tanggalSurat = Carbon::parse($suratUndangan->tanggal_surat)->locale(App::getLocale())->isoFormat('D MMMM Y');
            // dd($tanggalSurat);
        }

        $instansi = $suratUndangan->instansis;
        $logo = 'logoinstansi/' . $instansi->logo;
        $logoData = base64_encode(file_get_contents($logo));
        $src = 'data:' . mime_content_type($logo) . ';base64' . $logoData;
        $cap_surat = 'cap_suratinstansi/' . $instansi->cap_surat;
        $capData = base64_encode(file_get_contents($cap_surat));
        $src = 'data:' . mime_content_type($cap_surat) . ';base64' . $capData;
        $tanda_tangan = 'tanda_tanganinstansi/' . $instansi->tanda_tangan;
        $tanda_tanganData = base64_encode(file_get_contents($tanda_tangan));
        $src = 'data:' . mime_content_type($tanda_tangan) . ';base64' . $tanda_tanganData;
        $pdf = PDF::loadview('suratUndangan.surat_undanganPDF', ['tanggalSurat' => $tanggalSurat, 'suratUndangan' => $suratUndangan, 'instansi' => $instansi, 'logo' => $logo, 'cap_surat' => $cap_surat, 'tanda_tangan' => $tanda_tangan]);
        return $pdf->stream('Surat Undangan PDF.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suratUndangan = SuratUndangan::findOrFail($id);
        $instansi = Instansi::all();
        return view('suratUndangan.show', ['suratUndangan' => $suratUndangan, 'instansi' => $instansi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratUndangan = SuratUndangan::findOrFail($id);
        $instansis = Instansi::all();
        return view('suratUndangan.edit', ['suratUndangan' => $suratUndangan, 'instansis' => $instansis]);
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
        $suratUndangan = SuratUndangan::findOrFail($id);

        $suratUndangan->tempat_surat = $request->tempat_surat;
        $suratUndangan->tanggal_surat = $request->tanggal_surat;
        $suratUndangan->pengirim = $request->pengirim;
        $suratUndangan->perihal = $request->perihal;
        $suratUndangan->pnrm_surat = $request->pnrm_surat;
        $suratUndangan->alamat_surat = $request->alamat_surat;
        $suratUndangan->isi_surat = $request->isi_surat;
        $suratUndangan->tanggal_keg = $request->tanggal_keg;
        $suratUndangan->waktu_keg = $request->waktu_keg;
        $suratUndangan->tempat_keg = $request->tempat_keg;
        $suratUndangan->acara = $request->acara;
        $suratUndangan->save();

        return redirect('suratkeluar/suratUndangan')->with('success-edit', 'Surat Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suratUndangan = SuratUndangan::find($id);
        $suratUndangan->delete();
        return $id;
    }
}
