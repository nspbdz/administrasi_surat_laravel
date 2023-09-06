@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Jadwal Surat</h1>
    </div>
</section>
    <form class="main-form" action="{{ route('jadwalSurat.update', $jadwalSurat->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" placeholder="Tanggal" class="form-control"
                value="{{old('tanggal', $jadwalSurat->tanggal)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_keg" placeholder="Nama Kegiatan" class="form-control"
                value="{{old('nama_keg', $jadwalSurat->nama_keg)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Jenis Surat</label>
            <input type="text" name="jenis_surat" placeholder="Jenis Surat" class="form-control"
                value="{{old('jenis_surat', $jadwalSurat->jenis_surat)}}">
        </div>
        
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{route('jadwalSurat.index')}}" class="btn btn-secondary">Kembali</a>
    </form>

@endsection

