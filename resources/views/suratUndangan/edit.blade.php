@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Surat Undangan</h1>
    </div>
</section>
<form class="main-form" action="{{ route('suratUndangan.update', $suratUndangan->id)}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="tempat_surat" class="form-label">Tempat Surat</label>
        <input type="text" id="tempat_surat" name="tempat_surat" placeholder="Tempat Surat" class="form-control"
            value="{{ old('tempat_surat', $suratUndangan->tempat_surat) }}">
    </div>
    <div class="mb-3">
        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
        <input type="date" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Surat" class="form-control"
            value="{{ old('tanggal_surat', $suratUndangan->tanggal_surat) }}">
    </div>
    <div class="mb-3">
        <label for="pengirim" class="form-label">Pengirim</label>
        <input type="text" id="pengirim" name="pengirim" placeholder="Pengirim"
            class="form-control" value="{{ old('pengirim', $suratUndangan->pengirim) }}">
    </div>
    <div class="mb-3">
        <label for="perihal" class="form-label">Perihal</label>
        <input type="text" id="perihal" name="perihal" placeholder="Perihal" class="form-control"
            value="{{ old('perihal', $suratUndangan->perihal) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="pnrm_surat" class="form-label">Penerima Surat</label>
        <input type="text" id="pnrm_surat" name="pnrm_surat" placeholder="Penerima Surat" class="form-control"
            value="{{ old('pnrm_surat', $suratUndangan->pnrm_surat) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="alamat_surat" class="form-label">Alamat Tujuan</label>
        <input type="text" id="alamat_surat" name="alamat_surat" placeholder="Alamat Tujuan"
            class="form-control" value="{{ old('alamat_surat', $suratUndangan->alamat_surat) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="isi_surat" class="form-label">Isi Surat</label>
        <textarea name="isi_surat" id="isi_surat">{{$suratUndangan->isi_surat}}</textarea>
    </div>
    <div class="mb-3">
        <label for="tanggal_keg" class="form-label">Tanggal Kegiatan</label>
        <input type="date" id="tanggal_keg" name="tanggal_keg" placeholder="Tanggal Kegiatan" class="form-control"
            value="{{ old('tanggal_keg', $suratUndangan->tanggal_keg) }}">
    </div>
    <div class="mb-3">
        <label for="waktu_keg" class="form-label">Waktu Kegiatan</label>
        <input type="text" id="waktu_keg" name="waktu_keg" placeholder="Waktu Kegiatan" class="form-control"
            value="{{ old('waktu_keg', $suratUndangan->waktu_keg) }}">
    </div>
    <div class="mb-3">
        <label for="tempat_keg" class="form-label">Tempat Kegiatan</label>
        <input type="text" id="tempat_keg" name="tempat_keg" placeholder="Tempat Kegiatan" class="form-control"
            value="{{ old('tempat_keg', $suratUndangan->tempat_keg) }}">
    </div>
    <div class="mb-3">
        <label for="acara" class="form-label">Acara</label>
        <textarea name="acara" id="acara">{{$suratUndangan->acara}}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('suratUndangan.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection