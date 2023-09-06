<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenSertifikat;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class DokumenSertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('dokumenSertifikat.index', compact('request'));
    }

    public function getDokumenSertifikat(Request $request)
    {
        if ($request->ajax()) {
            $data = DokumenSertifikat::select('*')->orderBy('tanggal', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($value) {
                    $date = Carbon::parse($value->tanggal)->format('d-m-Y');
                    return $date;
                })

                ->addColumn('action', function ($value) {
                    if (auth()->check() && auth()->user()->can('file_sertifikat-action')) {

                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                    <a href="' . route('dokumenSertifikat.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i
                            class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('dokumenSertifikat.edit', $value->id) . '"><i
                            class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;
                            </div>';
                    } else if (auth()->check() && auth()->user()->can('file_sertifikat-show')) {
                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                    <a href="' . route('dokumenSertifikat.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i
                            class="fas fa-info"></i>&nbsp;</a>&nbsp;
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
        return view('dokumenSertifikat.create');
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

        $dokumenSertifikat = new DokumenSertifikat();
        $dokumenSertifikat->tanggal = $request->tanggal;
        $dokumenSertifikat->nama_dok = $request->nama_dok;

        if ($request->hasFile('file_dok')) {
            $request->file('file_dok')->move('file_dokumenSertifikat/', $request->file('file_dok')->getClientOriginalName());
            $dokumenSertifikat->file_dok = $request->file('file_dok')->getClientOriginalName();
            $dokumenSertifikat->save();
        }

        $dokumenSertifikat->save();

        return redirect('dokumenData/dokumenSertifikat')->with('success', 'Dokumen Berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumenSertifikat = DokumenSertifikat::findOrFail($id);
        return view('dokumenSertifikat.show', ['dokumenSertifikat' => $dokumenSertifikat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumenSertifikat = DokumenSertifikat::findOrFail($id);
        return view('dokumenSertifikat.edit', ['dokumenSertifikat' => $dokumenSertifikat]);
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
        $dokumenSertifikat = DokumenSertifikat::findOrFail($id);
        $dokumenSertifikat->tanggal = $request->tanggal;
        $dokumenSertifikat->nama_dok = $request->nama_dok;

        if ($request->hasFile('file_dok')) {
            $request->file('file_dok')->move('file_dokumenSertifikat/', $request->file('file_dok')->getClientOriginalName());
            $dokumenSertifikat->file_dok = $request->file('file_dok')->getClientOriginalName();
            $dokumenSertifikat->save();
        }

        $dokumenSertifikat->save();

        return redirect('dokumenData/dokumenSertifikat')->with('success-edit', 'Dokumen Berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
