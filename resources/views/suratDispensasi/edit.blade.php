@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Surat Dispensasi</h1>
    </div>
</section>
<form class="main-form" action="{{ route('suratDispensasi.update', $suratDispensasi->id)}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="tempat_surat" class="form-label">Tempat Surat</label>
        <input type="text" id="tempat_surat" name="tempat_surat" placeholder="Tempat Surat" class="form-control"
            value="{{ old('tempat_surat', $suratDispensasi->tempat_surat) }}">
    </div>
    <div class="mb-3">
        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
        <input type="date" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Surat" class="form-control"
            value="{{ old('tanggal_surat', $suratDispensasi->tanggal_surat) }}">
    </div>
    <div class="mb-3">
        <label for="nama_siswa" class="form-label">Nama Siswa</label>
        <input type="text" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa"
            class="form-control" value="{{ old('nama_siswa', $suratDispensasi->nama_siswa) }}">
    </div>
    <div class="mb-3">
        <label for="asal_mdta" class="form-label">Asal Madrasah</label>
        <input type="text" id="asal_mdta" name="asal_mdta" placeholder="Asal Madrasah" class="form-control"
            value="{{ old('asal_mdta', $suratDispensasi->asal_mdta) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="isi_surat" class="form-label">Isi Surat</label>
        <textarea name="isi_surat" id="isi_surat">{{$suratDispensasi->isi_surat}}</textarea>
    </div>
    <div class="mb-3">
        <label for="tanggal_dispensasi" class="form-label">Tanggal Dispensasi</label>
        <input type="date" id="tanggal_dispensasi" name="tanggal_dispensasi" placeholder="Tanggal Dispensasi" class="form-control"
            value="{{ old('tanggal_dispensasi', $suratDispensasi->tanggal_dispensasi) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="tempat_dispensasi" class="form-label">Tempat Dispensasi</label>
        <input type="text" id="tempat_dispensasi" name="tempat_dispensasi" placeholder="Tempat Dispensasi"
            class="form-control" value="{{ old('tempat_dispensasi', $suratDispensasi->tempat_dispensasi) ??"-" }}">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('suratDispensasi.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection