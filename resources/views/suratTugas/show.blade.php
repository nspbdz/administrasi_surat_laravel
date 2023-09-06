@extends('layouts.main')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Detail Surat Tugas</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th width="200px">Jenis Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratTugas->jenis_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tempat Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratTugas->tempat_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanggal Surat</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($suratTugas->tanggal_surat)->format('d-m-Y')}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nomor Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratTugas->no_surat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nama Pegawai</th>
                        <th width="30px">:</th>
                        <th>{{ $suratTugas->nama_pegawai}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Jabatan</th>
                        <th width="30px">:</th>
                        <th>{{ $suratTugas->jabatan}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Isi Surat</th>
                        <th width="30px">:</th>
                        <th>{!! $suratTugas->isi_surat !!}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanggal Tugas</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($suratTugas->tanggal_tugas)->format('d-m-Y')}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tempat Tugas</th>
                        <th width="30px">:</th>
                        <th>{{ $suratTugas->tempat_tugas}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanda Tangan</th>
                        <th width="30px">:</th>
                        <th>{{ $suratTugas->instansis->nama_pj}}</th>
                    </tr>
                </table>
            </div>
        </div>
        <tr>
            <th><a href="{{route('suratTugas.index')}}" class="btn btn-secondary">Kembali</a></th>

            <th><a href="{{route('generatePDFTugas', ['id' => $suratTugas->id])}}" target="_blank"
                    class="btn btn-primary">Cetak PDF</a></th></tr>
    </div>
</section>
@endsection
