<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:dokumen-create', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // $dokumen = Dokumen::latest()->paginate(5);
        // return view('dokumen.index',compact('dokumen'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        return view('dokumen.index', compact('request'));
    }

    public function getDokumen(Request $request)
    {
        if ($request->ajax()) {
            $data = Dokumen::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($value) {
                    $date = Carbon::parse($value->tanggal)->format('d-m-Y');
                    return $date;
                })

                ->addColumn('action', function ($value) {
                    if (auth()->check() && auth()->user()->can('dokumen-action')) {
                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                    <a href="' . route('dokumen.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i
                            class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('dokumen.edit', $value->id) . '"><i
                            class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;
                </div>';
                    } else if (auth()->check() && auth()->user()->can('dokumen-show')) {
                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                        <a href="' . route('dokumen.show', $value->id) . '"
                            class="btn btn-warning btn-sm"><i
                                class="fas fa-info"></i>&nbsp;</a>&nbsp';
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
        return view('dokumen.create');
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
            'nama_dok' => 'required',
            'file_dok' => 'required',
        ], [
            'tanggal.required' => 'Tanggal Dokumen Wajib di Isi !',
            'nama_dok.required' => 'Nama Dokumen Wajib di Isi !',
            'file_dok.required' => 'Upload File Wajib di Isi !',
        ]);

        $dokumen = new Dokumen();
        $dokumen->tanggal = $request->tanggal;
        $dokumen->nama_dok = $request->nama_dok;

        if ($request->hasFile('file_dok')) {
            $request->file('file_dok')->move('file_dokumen/', $request->file('file_dok')->getClientOriginalName());
            $dokumen->file_dok = $request->file('file_dok')->getClientOriginalName();
            $dokumen->save();
        }

        $dokumen->save();

        return redirect('dokumen')->with('success', 'Dokumen Berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('dokumen.show', ['dokumen' => $dokumen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('dokumen.edit', ['dokumen' => $dokumen]);
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
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->tanggal = $request->tanggal;
        $dokumen->nama_dok = $request->nama_dok;

        if ($request->hasFile('file_dok')) {
            $request->file('file_dok')->move('file_dokumen/', $request->file('file_dok')->getClientOriginalName());
            $dokumen->file_dok = $request->file('file_dok')->getClientOriginalName();
            $dokumen->save();
        }

        $dokumen->save();

        return redirect('dokumen')->with('success-edit', 'Dokumen Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::find($id);
        $dokumen->delete();
        return $id;
    }
}
