@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Surat Pemberitahuan</h1>
    </div>
</section>
<form class="main-form" action="{{ route('suratPemberitahuan.update', $suratPemberitahuan->id)}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="tempat_surat" class="form-label">Tempat Surat</label>
        <input type="text" id="tempat_surat" name="tempat_surat" placeholder="Tempat Surat" class="form-control"
            value="{{ old('tempat_surat', $suratPemberitahuan->tempat_surat) }}">
    </div>
    <div class="mb-3">
        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
        <input type="date" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Surat" class="form-control"
            value="{{ old('tanggal_surat', $suratPemberitahuan->tanggal_surat) }}">
    </div>
    <div class="mb-3">
        <label for="pengirim" class="form-label">Pengirim</label>
        <input type="text" id="pengirim" name="pengirim" placeholder="Pengirim"
            class="form-control" value="{{ old('pengirim', $suratPemberitahuan->pengirim) }}">
    </div>
    <div class="mb-3">
        <label for="perihal" class="form-label">Perihal</label>
        <input type="text" id="perihal" name="perihal" placeholder="Perihal" class="form-control"
            value="{{ old('perihal', $suratPemberitahuan->perihal) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="pnrm_surat" class="form-label">Penerima Surat</label>
        <input type="text" id="pnrm_surat" name="pnrm_surat" placeholder="Penerima Surat" class="form-control"
            value="{{ old('pnrm_surat', $suratPemberitahuan->pnrm_surat) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="alamat_surat" class="form-label">Alamat Tujuan</label>
        <input type="text" id="alamat_surat" name="alamat_surat" placeholder="Alamat Tujuan"
            class="form-control" value="{{ old('alamat_surat', $suratPemberitahuan->alamat_surat) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="isi_surat" class="form-label">Isi Surat</label>
        <textarea name="isi_surat" id="isi_surat">{{$suratPemberitahuan->isi_surat}}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('suratPemberitahuan.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection