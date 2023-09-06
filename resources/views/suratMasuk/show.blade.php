@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Surat Masuk</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="200px">Status Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratMasuk->status }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Jenis Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratMasuk->jenis_surat }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nama Perusahaan</th>
                        <th width="30px">:</th>
                        <th>{{ $suratMasuk->instansis->nama_instansi }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nomor Registrasi</th>
                        <th width="30px">:</th>
                        <th>{{ $suratMasuk->nmr_registrasi }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Tanggal</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($suratMasuk->tanggal)->format('d-m-Y')}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nomor Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratMasuk->no_surat }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Asal Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratMasuk->asal_surat }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Perihal</th>
                        <th width="30px">:</th>
                        <th>{{ $suratMasuk->perihal }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Penerima Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $suratMasuk->pnrm_surat }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nama File</th>
                        <th width="30px">:</th>
                        <!-- <th><file src="{{asset('file/' . $suratMasuk->file_doct)}}"></th> -->
                        <th>{{ $suratMasuk->file_surat }}</th>
                    </tr>
                </table>
                <br>
            </div>
            <div align="right">
                <iframe src="{{asset('file_surat/' . $suratMasuk->file_surat)}}" width="750px" height="500px"></iframe>
            </div>
        </div>
        <tr>
           <th>
               <a href="{{route('suratMasuk.index')}}" class="btn btn-secondary">Kembali</a>
           </th>
        </tr>
    </div>
</section>
@endsection

