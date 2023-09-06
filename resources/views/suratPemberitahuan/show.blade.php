@extends('layouts.main')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Detail Surat Pemberitahuan</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th width="200px">Jenis Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratPemberitahuan->jenis_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tempat Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratPemberitahuan->tempat_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanggal Surat</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($suratPemberitahuan->tanggal_surat)->format('d-m-Y')}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nomor Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratPemberitahuan->no_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Perihal</th>
                        <th width="30px">:</th>
                        <th>{{ $suratPemberitahuan->perihal}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Isi Surat</th>
                        <th width="30px">:</th>
                        <th>{!! $suratPemberitahuan->isi_surat !!}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanda Tangan</th>
                        <th width="30px">:</th>
                        <th>{{ $suratPemberitahuan->instansis->nama_pj}}</th>
                    </tr>
                </table>
            </div>
        </div>
        <tr>
            <th><a href="{{route('suratPemberitahuan.index')}}" class="btn btn-secondary">Kembali</a></th>

            <th><a href="{{route('generatePDFPemberitahuan', ['id' => $suratPemberitahuan->id])}}" target="_blank"
                    class="btn btn-primary">Cetak PDF</a></th></tr>
    </div>
</section>
@endsection
