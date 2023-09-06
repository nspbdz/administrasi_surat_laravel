<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:instansi-create', ['only' => ['create', 'store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $user = $user['roles'][0]['code'];
        // dd($user);
        // $instansi = Instansi::latest()->paginate(5);
        // return view('instansi.index',compact('instansi'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        return view('instansi.index', compact('request'));
    }

    public function getInstansi(Request $request)
    {
        $user = Auth::user();
        $user = $user['roles'][0]['code'];
        $excludedRoles = ['dpp', 'dpc', 'dpw'];

        if ($request->ajax()) {
            if ($user == "dpp" || $user == "dpc" || $user == "dpw") {
                $data = Instansi::select('*')->where("role_code", "=", $user);
            } else {
                $data = Instansi::select('*')
                    ->whereNotIn("role_code", $excludedRoles);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($value) {
                    if (auth()->check() && auth()->user()->can('instansi-action')) {

                        $btn = '<div class="d-flex flex-row bd-higlight mb-3">
                        <a href="' . route('instansi.show', $value->id) . '"
                            class="btn btn-warning btn-sm"><i class="fas fa-info"></i>&nbsp;</a>&nbsp;

                        <a class="btn btn-info btn-sm"
                            href="' . route('instansi.edit', $value->id) . '">
                                <i class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;
                    </div>';
                    } else if (auth()->check() && auth()->user()->can('instansi-show')) {
                        $btn = '<div class="d-flex flex-row bd-higlight mb-3">
                        <a href="' . route('instansi.show', $value->id) . '"
                            class="btn btn-warning btn-sm"><i class="fas fa-info"></i>&nbsp;</a>&nbsp';
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
        return view('instansi.create');
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
            'nama_instansi' => 'required',
            'cabang_instansi' => 'required',
            'nama_pj' => 'required',
            'jabatan' => 'required',
            'nip' => 'required',
            'alamat' => 'required',
            'nmr_telepon' => 'required',
            'kode_instansi' => 'required',
            'logo' => 'required',
            'tanda_tangan' => 'required',
            'cap_surat' => 'required',
        ], [
            'nama_instansi.required' => 'Nama Instansi Wajib di Isi !',
            'cabang_instansi.required' => 'Cabang Instansi Wajib di Isi !',
            'nama_pj.required' => 'Nama Penanggung Jawab Wajib di Isi !',
            'jabatan.required' => 'Jabatan Wajib di Isi !',
            'nip.required' => 'Nip Wajib di Isi !',
            'alamat.required' => 'Alamat Wajib di Isi !',
            'nmr_telepon.required' => 'Nomor Telepone Wajib di Isi !',
            'kode_instansi.required' => 'Kode Instansi Wajib di Isi !',
            'logo.required' => 'Logo Instansi Wajib di Isi !',
            'tanda_tangan.required' => 'Tanda Tangan Instansi Wajib di Isi !',
            'cap_surat.required' => 'Cap Surat Instansi Wajib di Isi !',
        ]);

        $instansi = new Instansi();
        $instansi->nama_instansi = $request->nama_instansi;
        $instansi->cabang_instansi = $request->cabang_instansi;
        $instansi->nama_pj = $request->nama_pj;
        $instansi->jabatan = $request->jabatan;
        $instansi->nip = $request->nip;
        $instansi->alamat = $request->alamat;
        $instansi->nmr_telepon = $request->nmr_telepon;
        $instansi->kode_instansi = $request->kode_instansi;
        $instansi->role_code = $user['roles'][0]['code'];


        if ($request->hasFile('logo')) {
            $request->file('logo')->move('logoinstansi/', $request->file('logo')->getClientOriginalName());
            $instansi->logo = $request->file('logo')->getClientOriginalName();
            $instansi->save();
        }

        if ($request->hasFile('tanda_tangan')) {
            $request->file('tanda_tangan')->move('tanda_tanganinstansi/', $request->file('tanda_tangan')->getClientOriginalName());
            $instansi->tanda_tangan = $request->file('tanda_tangan')->getClientOriginalName();
            $instansi->save();
        }

        if ($request->hasFile('cap_surat')) {
            $request->file('cap_surat')->move('cap_suratinstansi/', $request->file('cap_surat')->getClientOriginalName());
            $instansi->cap_surat = $request->file('cap_surat')->getClientOriginalName();
            $instansi->save();
        }

        $instansi->save();

        return redirect('instansi')->with('success', 'Data Instansi Berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instansi = Instansi::findOrFail($id);
        return view('instansi.show', ['instansi' => $instansi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        return view('instansi.edit', ['instansi' => $instansi]);
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
        $instansi = Instansi::findOrFail($id);
        $instansi->nama_instansi = $request->nama_instansi;
        $instansi->cabang_instansi = $request->cabang_instansi;
        $instansi->nama_pj = $request->nama_pj;
        $instansi->jabatan = $request->jabatan;
        $instansi->nip = $request->nip;
        $instansi->alamat = $request->alamat;
        $instansi->nmr_telepon = $request->nmr_telepon;
        $instansi->kode_instansi = $request->kode_instansi;

        if ($request->hasFile('logo')) {
            $request->file('logo')->move('logoinstansi/', $request->file('logo')->getClientOriginalName());
            $instansi->logo = $request->file('logo')->getClientOriginalName();
            $instansi->save();
        }

        if ($request->hasFile('tanda_tangan')) {
            $request->file('tanda_tangan')->move('tanda_tanganinstansi/', $request->file('tanda_tangan')->getClientOriginalName());
            $instansi->tanda_tangan = $request->file('tanda_tangan')->getClientOriginalName();
            $instansi->save();
        }

        if ($request->hasFile('cap_surat')) {
            $request->file('cap_surat')->move('cap_suratinstansi/', $request->file('cap_surat')->getClientOriginalName());
            $instansi->cap_surat = $request->file('cap_surat')->getClientOriginalName();
            $instansi->save();
        }

        $instansi->save();

        return redirect('instansi')->with('success-edit', 'Data Instansi Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instansi = Instansi::find($id);
        $instansi->delete();
        return $id;
    }
}
