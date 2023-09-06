<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalSurat;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class JadwalSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:jadwal_surat-create', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // $jadwalSurat = JadwalSurat::latest()->paginate(5);
        // return view('jadwalSurat.index',compact('jadwalSurat'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        return view('jadwalSurat.index', compact('request'));
    }


    public function getJadwalSurat(Request $request)
    {
        if ($request->ajax()) {
            $data = JadwalSurat::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($value) {
                    $date = Carbon::parse($value->tanggal)->format('d-m-Y');
                    return $date;
                })
                ->addColumn('action', function ($value) {

                    if (auth()->check() && auth()->user()->can('jadwal_surat-action')) {

                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                    <a href="' . route('jadwalSurat.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i
                            class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('jadwalSurat.edit', $value->id) . '"><i
                            class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;

                    <button class="btn btn-danger delete" id="' . $value->id . '"
                        nama="' . $value->nama . '" type="submit" onclick="deleteJadwalSurat(' . $value->id . ')"><i
                            class="fas fa-trash"></i></button>
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
        return view('jadwalSurat.create');
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
            'tanggal' => 'required',
            'nama_keg' => 'required',
            'jenis_surat' => 'required',
        ], [
            'tanggal.required' => 'Tanggal Jadwal Surat Wajib di Isi !',
            'nama_keg.required' => 'Nama Kegiatan Wajib di Isi !',
            'jenis_surat.required' => 'Jenis Kegiatan Wajib di Isi !',
        ]);

        $jadwalSurat = new JadwalSurat();
        $jadwalSurat->tanggal = $request->tanggal;
        $jadwalSurat->nama_keg = $request->nama_keg;
        $jadwalSurat->jenis_surat = $request->jenis_surat;
        $jadwalSurat->save();

        return redirect('jadwalSurat')->with('success', 'Jadwal Surat Berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwalSurat = JadwalSurat::findOrFail($id);
        return view('jadwalSurat.show', ['jadwalSurat' => $jadwalSurat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwalSurat = JadwalSurat::findOrFail($id);
        return view('jadwalSurat.edit', ['jadwalSurat' => $jadwalSurat]);
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
        $jadwalSurat = JadwalSurat::findOrFail($id);
        $jadwalSurat->tanggal = $request->tanggal;
        $jadwalSurat->nama_keg = $request->nama_keg;
        $jadwalSurat->jenis_surat = $request->jenis_surat;
        $jadwalSurat->save();

        return redirect('jadwalSurat')->with('success-edit', 'Jadwal Surat Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwalSurat = JadwalSurat::find($id);
        $jadwalSurat->delete();
        return $id;
    }
}
