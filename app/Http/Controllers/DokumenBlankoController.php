<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenBlanko;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class DokumenBlankoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return view('dokumenBlanko.index', compact('request'));
    }

    public function getDokumenBlanko(Request $request)
    {
        if ($request->ajax()) {
            $data = DokumenBlanko::select('*')->orderBy('tanggal', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($value) {
                    $date = Carbon::parse($value->tanggal)->format('d-m-Y');
                    return $date;
                })
                ->addColumn('action', function ($value) {
                    if (auth()->check() && auth()->user()->can('file_blanko-action')) {
                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                    <a href="' . route('dokumenBlanko.show', $value->id) . '"
                        class="btn btn-warning btn-sm"><i
                            class="fas fa-info"></i>&nbsp;</a>&nbsp;

                    <a class="btn btn-info btn-sm"
                        href="' . route('dokumenBlanko.edit', $value->id) . '"><i
                            class="fas fa-pen-fancy"></i>&nbsp;</a>&nbsp;
                </div>';
                    } else if (auth()->check() && auth()->user()->can('file_blanko-show')) {
                        $btn = '<div class="d-flex flex-row bd-highlight mb-3">
                        <a href="' . route('dokumenBlanko.show', $value->id) . '"
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
        return view('dokumenBlanko.create');
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
            'file_doct' => 'required',
        ], [
            'tanggal.required' => 'Tanggal Dokumen Wajib di Isi !',
            'nama_dok.required' => 'Nama Dokumen Wajib di Isi !',
            'file_doct.required' => 'Upload File Wajib di Isi !',
        ]);

        $dokumenBlanko = new DokumenBlanko();
        $dokumenBlanko->tanggal = $request->tanggal;
        $dokumenBlanko->nama_dok = $request->nama_dok;

        if ($request->hasFile('file_doct')) {
            $request->file('file_doct')->move('file_dokumenBlanko/', $request->file('file_doct')->getClientOriginalName());
            $dokumenBlanko->file_doct = $request->file('file_doct')->getClientOriginalName();
            $dokumenBlanko->save();
        }

        $dokumenBlanko->save();
        // return redirect('suratkeluar/suratPemberitahuan')->with('success', 'Surat Berhasil di tambahkan!');

        return redirect('dokumenData/dokumenBlanko')->with('success', 'Dokumen Berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumenBlanko = DokumenBlanko::findOrFail($id);
        return view('dokumenBlanko.show', ['dokumenBlanko' => $dokumenBlanko]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumenBlanko = DokumenBlanko::findOrFail($id);
        return view('dokumenBlanko.edit', ['dokumenBlanko' => $dokumenBlanko]);
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
        $dokumenBlanko = DokumenBlanko::findOrFail($id);
        $dokumenBlanko->tanggal = $request->tanggal;
        $dokumenBlanko->nama_dok = $request->nama_dok;

        if ($request->hasFile('file_doct')) {
            $request->file('file_doct')->move('file_dokumenBlanko/', $request->file('file_doct')->getClientOriginalName());
            $dokumenBlanko->file_doct = $request->file('file_doct')->getClientOriginalName();
            $dokumenBlanko->save();
        }

        $dokumenBlanko->save();

        return redirect('dokumenData/dokumenBlanko')->with('success-edit', 'Dokumen Berhasil di edit!');
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
