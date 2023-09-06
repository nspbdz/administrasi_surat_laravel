<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenSurat;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class DokumenSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('dokumenSurat.index', compact('request'));
    }

    public function getDokumenSurat(Request $request)
    {
        if ($request->ajax()) {
            $data = DokumenSurat::select('*')->orderBy('tanggal', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($value) {
                    $date = Carbon::parse($value->tanggal)->format('d-m-Y');
                    return $date;
                })

                ->addColumn('action', function ($value) {
                    if (auth()->check() && auth()->user()->can('file_surat-keluar-action')) {

                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                    <a href="' . route('dokumenSurat.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i
                            class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('dokumenSurat.edit', $value->id) . '"><i
                            class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;
                </div>';
                    } else if (auth()->check() && auth()->user()->can('file_surat-keluar-show')) {
                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                        <a href="' . route('dokumenSurat.show', $value->id) . '"
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
        return view('dokumenSurat.create');
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

        $dokumenSurat = new DokumenSurat();
        $dokumenSurat->tanggal = $request->tanggal;
        $dokumenSurat->nama_dok = $request->nama_dok;

        if ($request->hasFile('file_dok')) {
            $request->file('file_dok')->move('file_dokumenSurat/', $request->file('file_dok')->getClientOriginalName());
            $dokumenSurat->file_dok = $request->file('file_dok')->getClientOriginalName();
            $dokumenSurat->save();
        }

        $dokumenSurat->save();
        // return redirect('dokumenData/dokumenBlanko')->with('success-edit', 'Dokumen Berhasil di edit!');

        return redirect('dokumenData/dokumenSurat')->with('success', 'Dokumen Berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumenSurat = DokumenSurat::findOrFail($id);
        return view('dokumenSurat.show', ['dokumenSurat' => $dokumenSurat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumenSurat = DokumenSurat::findOrFail($id);
        return view('dokumenSurat.edit', ['dokumenSurat' => $dokumenSurat]);
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
        $dokumenSurat = DokumenSurat::findOrFail($id);
        $dokumenSurat->tanggal = $request->tanggal;
        $dokumenSurat->nama_dok = $request->nama_dok;

        if ($request->hasFile('file_dok')) {
            $request->file('file_dok')->move('file_dokumenSurat/', $request->file('file_dok')->getClientOriginalName());
            $dokumenSurat->file_dok = $request->file('file_dok')->getClientOriginalName();
            $dokumenSurat->save();
        }

        $dokumenSurat->save();

        return redirect('dokumenData/dokumenSurat')->with('success-edit', 'Dokumen Berhasil di edit!');
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
