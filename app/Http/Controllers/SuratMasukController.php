<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Yajra\DataTables\DataTables;
use App\Models\Instansi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:surat_masuk-create', ['only' => ['create', 'store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $excludedRoles = ['dpp', 'dpc', 'dpw'];

        // $data = SuratMasuk::select('*')
        //     ->with('instansis')
        //     ->whereNotIn("role_code", $excludedRoles)
        //     ->get();
        // dd($data);
        // $user = Auth::user();

        // dd($user['roles'][0]['code']);
        // $suratMasuk = SuratMasuk::latest()->paginate(5);
        // return view('suratMasuk.index',compact('suratMasuk'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        return view('suratMasuk.index', compact('request'));
    }

    public function getSuratMasuk(Request $request)
    {
        $user = Auth::user();
        $user = $user['roles'][0]['code'];
        $excludedRoles = ['dpp', 'dpc', 'dpw'];

        // dd($user);
        // dd($user['roles'][0]['code']);

        if ($request->ajax()) {
            if ($user == "dpp" || $user == "dpc" || $user == "dpw") {
                $data = SuratMasuk::select('*')->with('instansis')->where("role_code", "=", $user)->orderBy('tanggal', 'desc');
            } else {
                $data = SuratMasuk::select('*')
                    ->with('instansis')
                    ->whereNotIn("role_code", $excludedRoles)->orderBy('tanggal', 'desc');
            }

            // $data = SuratMasuk::select('*')->with('instansis');
            $data->when($request->awal, function ($value) use ($request) {
                $value->where('tanggal', '>=', $request->awal);
            });
            $data->when($request->akhir, function ($value) use ($request) {
                $value->where('tanggal', '<=', $request->akhir);
            });
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('instansis', function ($value) {
                    return $value->instansis->nama_instansi;
                })
                // ->addColumn('origin_letter', function($value){
                //    if($value->other_companies == null){
                //     return $value->externalCompany->name;
                //    }else return $value->other_companies;
                // })
                ->addColumn('tanggal', function ($value) {
                    $tanggal = Carbon::parse($value->tanggal)->format('d-m-Y');
                    return $tanggal;
                })
                ->addColumn('status_badges', function ($value) {
                    if ($value->status == 'Balas') {
                        $badge = '<span class="badge badge-pill badge-success">Balas</span>';
                        return $badge;
                    } else {
                        $badge = '<span class="badge badge-pill badge-danger">Tidak Balas</span>';
                        return $badge;
                    }
                })
                ->addColumn('action', function ($value) {
                    if (auth()->check() && auth()->user()->can('surat_masuk-action')) {

                        if ($value->status == 'Balas') {
                            $btn = '<div class="d-flex flex-row bd-highlight mb-3">

                    <a href="' . route('suratMasuk.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i
                            class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('suratMasuk.edit', $value->id) . '"><i
                            class="fas fa-pen-fancy" data-file_surat="' . $value['file_surat'] . '"></i>&nbsp;</a>&nbsp;

                    <button type="button" class="btn btn-danger" id = "statusundo" onclick="statusundo(' . $value->id . ')"><i
                    class="fas fa-undo-alt"></i></button>

                </div>';
                            return $btn;
                        } else {
                            $btn = '<div class="d-flex flex-row bd-highlight mb-3">

                    <a href="' . route('suratMasuk.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i
                            class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('suratMasuk.edit', $value->id) . '"><i
                            class="fas fa-pen-fancy" data-file_surat="' . $value['file_surat'] . '"></i>&nbsp;</a>&nbsp;

                    <button type="button" class="btn btn-primary" id = "status" onclick="status(' . $value->id . ')"><i
                            class="fa fa-check"></i></button>
                </div>';

                            return $btn;
                        }
                    } else if (auth()->check() && auth()->user()->can('surat_tugas-show')) {
                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">

                        <a href="' . route('suratMasuk.show', $value->id) . '"
                            class="btn btn-warning btn-sm"><i
                                class="fas fa-info"></i>&nbsp;</a>&nbsp';
                    } else {
                        $btn = ''; // Empty string if the condition is not met
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'status_badges']) //, 'origin_letter'
                ->make(true);
        }
    }

    public function status($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $suratMasuk->status = 'Balas';
        $suratMasuk->save();
    }

    public function statusUndo($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $suratMasuk->status = 'Belum Balas';
        $suratMasuk->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instansi = Instansi::all();
        return view('suratMasuk.create', ['instansi' => $instansi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($user['roles'][0]['code']);
        $user = Auth::user();

        $request->validate([
            'jenis_surat' => 'required',
            'no_surat' => 'required',
            'tanggal' => 'required',
            'instansis_id' => 'required',
            'perihal' => 'required',
            'asal_surat' => 'required',
            'pnrm_surat' => 'required',
            'file_surat' => 'required | mimes:doc,docx,pdf',

        ], [
            'jenis_surat.required' => 'Jenis Surat Wajib diisi!',
            'no_surat.required' => 'Nomor Surat Wajib diisi!',
            'tanggal.required' => 'Tanggal Wajib diisi!',
            'instansis_id.required' => 'Nama Instansi Wajib diisi!',
            'perihal.required' => 'Perihal Wajib diisi!',
            'asal_surat.required' => 'Asal surat Wajib diisi!',
            'pnrm_surat.required' => 'Penerima Surat Wajib diisi!',
            'file_surat.required' => 'File Wajib diisi!',
        ]);

        $suratMasuk = new SuratMasuk();
        $suratMasuk->jenis_surat = $request->jenis_surat;
        $suratMasuk->instansis_id = $request->instansis_id;
        $suratMasuk->asal_surat = $request->asal_surat;
        $suratMasuk->status = 'Belum Balas';
        $suratMasuk->no_surat = $request->no_surat;
        $suratMasuk->tanggal = $request->tanggal;
        $suratMasuk->perihal = $request->perihal;
        $suratMasuk->pnrm_surat = $request->pnrm_surat;
        $suratMasuk->nmr_registrasi = $request->nmr_registrasi;
        $suratMasuk->role_code = $user['roles'][0]['code'];
        if ($request->hasFile('file_surat')) {
            $request->file('file_surat')->move('file_surat/', $request->file('file_surat')->getClientOriginalName());
            $suratMasuk->file_surat = $request->file('file_surat')->getClientOriginalName();
            // $suratMasuk->save();
        }
        $suratMasuk->save();
        // $suratMasuk = SuratMasuk::create($request->all());

        // if ($request->hasFile('file_surat')) {
        //     $request->file('file_surat')->move('file_surat/', $request->file('file_surat')->getClientOriginalName());
        //     $suratMasuk->file_surat = $request->file('file_surat')->getClientOriginalName();
        //     $suratMasuk->save();
        // }



        return redirect('suratMasuk')->with('success', 'Surat Berhasil di tambahkan!');
    }

    public function registrationNumberSuratMasuk(Request $request)
    {
        // $registrationNumber = SuratMasuk::registrationNumber($request);
        // $registrationNumber = sprintf("%04d", $registrationNumber);
        // $data= SuratMasuk::orderBy('id', 'desc')->first();
        // $data = SuratMasuk::max('id');
        // dd($data+1);
        $registrationNumber = SuratMasuk::where('jenis_surat', $request->jenis_surat)->where('instansis_id', $request->instansis)->count() + 1;
        // dd($registrationNumber);
        $registrationNumber = sprintf("%04d", $registrationNumber);
        // $registrationNumber = sprintf("%04d", $data+1);
        return $registrationNumber;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $instansi = Instansi::all();
        return view('suratMasuk.show', ['suratMasuk' => $suratMasuk, 'instansi' => $instansi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $instansis = Instansi::all();
        return view('suratMasuk.edit', ['suratMasuk' => $suratMasuk, 'instansis' => $instansis]);
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
        $suratMasuk = SuratMasuk::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            $request->file('file_surat')->move('file_surat/', $request->file('file_surat')->getClientOriginalName());
            $suratMasuk->file_surat = $request->file('file_surat')->getClientOriginalName();
            $suratMasuk->save();
        }

        $suratMasuk->jenis_surat = $request->jenis_surat;
        $suratMasuk->instansis_id = $request->instansis_id;
        $suratMasuk->asal_surat = $request->asal_surat;
        $suratMasuk->no_surat = $request->no_surat;
        $suratMasuk->tanggal = $request->tanggal;
        $suratMasuk->perihal = $request->perihal;
        $suratMasuk->pnrm_surat = $request->pnrm_surat;
        // $suratMasuk->registration_number = $request->registration_number;
        $suratMasuk->save();

        return redirect('suratMasuk')->with('success-edit', 'Surat Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::find($id);
        $suratMasuk->delete();
        return $id;
    }
}
