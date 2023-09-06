@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Jadwal Surat</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th width="200px">Tanggal</th>
                        <th width="30px">:</th>
                        <th>{{ Carbon\Carbon::parse($jadwalSurat->tanggal)->format('d-m-Y') }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Nama Kegiatan</th>
                        <th width="30px">:</th>
                        <th>{{ $jadwalSurat->nama_keg }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Jenis Surat</th>
                        <th width="30px">:</th>
                        <th>{{ $jadwalSurat->jenis_surat }}</th>
                    </tr>
                </table>
                <br>
            </div>
        </div>
        <tr>
            <th>
                <a href="{{route('jadwalSurat.index')}}" class="btn btn-secondary">Kembali</a>
            </th>
        </tr>
    </div>
</section>
@endsection
