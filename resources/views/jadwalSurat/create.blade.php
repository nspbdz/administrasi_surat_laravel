@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Jadwal Surat</h1>
    </div>
</section>
<div class="modal-body">
    <form class="main-form" action="{{ route('jadwalSurat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" placeholder="Tanggal"
                class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
            @error('tanggal')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_keg" placeholder="Nama Kegiatan"
                class="form-control @error('nama_keg') is-invalid @enderror" value="{{ old('nama_keg') }}">
            @error('nama_keg')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Jenis Surat</label>
            <input type="text" name="jenis_surat" placeholder="Jenis Surat"
                class="form-control @error('jenis_surat') is-invalid @enderror" value="{{ old('jenis_surat') }}">
            @error('jenis_surat')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
        <br>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{route('jadwalSurat.index')}}" class="btn btn-secondary">Batal</a>
    </form>
</div>


@endsection
