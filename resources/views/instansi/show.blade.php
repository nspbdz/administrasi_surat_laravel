@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Data Instansi</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th width="200px">Nama Instansi</th>
                        <th width="30px">:</th>
                        <th>{{ $instansi->nama_instansi}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Cabang Instansi</th>
                        <th width="35px">:</th>
                        <th>{{ $instansi->cabang_instansi}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nama Penanggung Jawab</th>
                        <th width="30px">:</th>
                        <th>{{ $instansi->nama_pj}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Jabatan</th>
                        <th width="30px">:</th>
                        <th>{{ $instansi->jabatan}}</th>
                    </tr>
                    <tr>
                        <th width="200px">NIP</th>
                        <th width="30px">:</th>
                        <th>{{ $instansi->nip}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Alamat</th>
                        <th width="30px">:</th>
                        <th>{{ $instansi->alamat}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nomor Telepone</th>
                        <th width="30px">:</th>
                        <th>{{ $instansi->nmr_telepon}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Kode Instansi</th>
                        <th width="30px">:</th>
                        <th>{{ $instansi->kode_instansi}}</th>
                    </tr>
                    <tr>
                        <th width="200px">Logo</th>
                        <th width="30px">:</th>
                        <th><img src="{{ url('logoinstansi/'. $instansi->logo) }}" width="300px"></th>
                    </tr>
                    <tr>
                        <th width="200px">Tanda Tangan</th>
                        <th width="30px">:</th>
                        <th><img src="{{ url('tanda_tanganinstansi/'. $instansi->tanda_tangan) }}" width="300px"></th>
                    </tr>
                    <tr>
                        <th width="200px">Cap Surat</th>
                        <th width="30px">:</th>
                        <th><img src="{{ url('cap_suratinstansi/'. $instansi->cap_surat) }}" width="300px"></th>
                    </tr>
                </table>
                <br><br><br><br><br>
                <tr>
                    <th><a href="{{ route('instansi.index') }}" class="btn btn-primary">Kembali</a></th>
                </tr>
            </div>
        </div>
    </div>
</section>
@endsection
