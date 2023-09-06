@extends('layouts.main')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Detail Surat Undangan</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th width="200px">Jenis Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratUndangan->jenis_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tempat Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratUndangan->tempat_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanggal Surat</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($suratUndangan->tanggal_surat)->format('d-m-Y')}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nomor Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratUndangan->no_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Perihal</th>
                        <th width="30px">:</th>
                        <th>{{ $suratUndangan->perihal}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Isi Surat</th>
                        <th width="30px">:</th>
                        <th>{!! $suratUndangan->isi_surat !!}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanggal Kegiatan</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($suratUndangan->tanggal_keg)->format('d-m-Y')}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Waktu Kegiatan</th>
                        <th width="30px">:</th>
                        <th>{{ $suratUndangan->waktu_keg}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tempat Kegiatan</th>
                        <th width="30px">:</th>
                        <th>{{ $suratUndangan->tempat_keg}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Acara</th>
                        <th width="30px">:</th>
                        <th>{!! $suratUndangan->acara !!}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanda Tangan</th>
                        <th width="30px">:</th>
                        <th>{{ $suratUndangan->instansis->nama_pj}}</th>
                    </tr>
                </table> 
            </div>
        </div>
        <tr>
            <th><a href="{{route('suratUndangan.index')}}" class="btn btn-secondary">Kembali</a></th>

            <th><a href="{{route('generatePDFUndangan', ['id' => $suratUndangan->id])}}" target="_blank"
                    class="btn btn-primary">Cetak PDF</a></th></tr>
    </div>
</section>
@endsection
