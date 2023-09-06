@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Dokumen Blanko</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th width="200px">Tanggal</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($dokumenBlanko->tanggal)->format('d-m-Y') }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nama Dokumen</th>
                        <th width="30px">:</th>
                        <th>{{ $dokumenBlanko->nama_dok }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nama File</th>
                        <th width="30px">:</th>
                        <th>{{ $dokumenBlanko->file_doct }}</th>
                    </tr>
                </table>
                <br>
            </div>
            <div align="center">
                <iframe src="{{asset('file_dokumenBlanko/' . $dokumenBlanko->file_doct)}}" width="750px" height="500px"></iframe>
            </div>
        </div>
        <tr>
            <th>
                <a href="{{route('dokumenBlanko.index')}}" class="btn btn-secondary">Kembali</a>
            </th>
        </tr>
    </div>
</section>
@endsection
