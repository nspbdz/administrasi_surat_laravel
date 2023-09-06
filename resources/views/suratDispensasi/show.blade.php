@extends('layouts.main')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Detail Surat Dispensasi</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th width="200px">Jenis Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratDispensasi->jenis_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tempat Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratDispensasi->tempat_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanggal Surat</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($suratDispensasi->tanggal_surat)->format('d-m-Y')}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nomor Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratDispensasi->no_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nama Siswa</th>
                        <th width="30px">:</th>
                        <th>{{ $suratDispensasi->nama_siswa}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Asal Madrasah</th>
                        <th width="30px">:</th>
                        <th>{{ $suratDispensasi->asal_mdta}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Isi Surat</th>
                        <th width="30px">:</th>
                        <th>{!! $suratDispensasi->isi_surat !!}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanggal Dispensasi</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($suratDispensasi->tanggal_dispensasi)->format('d-m-Y')}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tempat Dispensasi</th>
                        <th width="30px">:</th>
                        <th>{{ $suratDispensasi->tempat_dispensasi}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanda Tangan</th>
                        <th width="30px">:</th>
                        <th>{{ $suratDispensasi->instansis->nama_pj}}</th>
                    </tr>
                </table>
            </div>
        </div>
        <tr>
            <th><a href="{{route('suratDispensasi.index')}}" class="btn btn-secondary">Kembali</a></th>

            <th><a href="{{route('generatePDFDispensasi', ['id' => $suratDispensasi->id])}}" target="_blank"
                    class="btn btn-primary">Cetak PDF</a></th></tr>
    </div>
</section>
@endsection
