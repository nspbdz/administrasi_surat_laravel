@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Instansi</h1>
    </div>
</section>
<form class="main-form" action="{{ route('instansi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Nama Instansi</label>
        <input type="text" name="nama_instansi" placeholder="Nama Instansi"
            class="form-control @error('nama_instansi') is-invalid @enderror" id="nama_instansi" value="{{ old('nama_instansi') }}">
        @error('nama_instansi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Cabang Instansi</label>
        <input type="text" name="cabang_instansi" placeholder="Cabang Instansi"
            class="form-control @error('cabang_instansi') is-invalid @enderror" id="cabang_instansi" value="{{ old('cabang_instansi') }}">
        @error('cabang_instansi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Nama Penanggung Jawab</label>
        <input type="text" name="nama_pj" placeholder="Nama Penanggung Jawab"
            class="form-control @error('nama_pj') is-invalid @enderror" id="nama_pj" value="{{ old('nama_pj') }}">
        @error('nama_pj')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Jabatan</label>
        <input type="text" name="jabatan" placeholder="Jabatan"
            class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" value="{{ old('jabatan') }}">
        @error('jabatan')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">NIP</label>
        <input type="text" name="nip" placeholder="NIP"
            class="form-control @error('nip') is-invalid @enderror" id="nip" value="{{ old('nip') }}">
        @error('nip')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Alamat</label>
        <input type="text" name="alamat" placeholder="Alamat"
            class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat') }}">
        @error('alamat')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Nomor Telepone</label>
        <input type="text" name="nmr_telepon" placeholder="Nomor Telepone"
            class="form-control @error('nmr_telepon') is-invalid @enderror" id="nmr_telepon" value="{{ old('nmr_telepon') }}">
        @error('nmr_telepon')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Kode Instansi</label>
        <input type="text" name="kode_instansi" placeholder="Kode Instansi"
            class="form-control @error('kode_instansi') is-invalid @enderror" id="kode_instansi"
            value="{{ old('kode_instansi') }}">
        @error('kode_instansi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Masukan Logo</label>
        <img class="img-preview img-fluid d-block">
        <input class="form-control @error('logo') is-invalid @enderror" value="{{old('logo')}}" type="file" id="logo"
            name="logo">
        @error('logo')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Masukan Tanda Tangan</label>
        <img class="img-preview img-fluid d-block">
        <input class="form-control @error('tanda_tangan') is-invalid @enderror" value="{{old('tanda_tangan')}}" type="file" id="tanda_tangan"
            name="tanda_tangan">
        @error('tanda_tangan')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Masukan Cap Surat</label>
        <img class="img-preview img-fluid d-block">
        <input class="form-control @error('cap_surat') is-invalid @enderror" value="{{old('cap_surat')}}" type="file" id="cap_surat"
            name="cap_surat">
        @error('cap_surat')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('instansi.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection
