@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Surat Tugas</h1>
    </div>
</section>
<form class="main-form" action="{{ route('suratTugas.update', $suratTugas->id)}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="tempat_surat" class="form-label">Tempat Surat</label>
        <input type="text" id="tempat_surat" name="tempat_surat" placeholder="Tempat Surat" class="form-control"
            value="{{ old('tempat_surat', $suratTugas->tempat_surat) }}">
    </div>
    <div class="mb-3">
        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
        <input type="date" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Surat" class="form-control"
            value="{{ old('tanggal_surat', $suratTugas->tanggal_surat) }}">
    </div>
    <div class="mb-3">
        <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
        <input type="text" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai"
            class="form-control" value="{{ old('nama_pegawai', $suratTugas->nama_pegawai) }}">
    </div>
    <div class="mb-3">
        <label for="jabatan" class="form-label">Jabatan</label>
        <input type="text" id="jabatan" name="jabatan" placeholder="jabatan" class="form-control"
            value="{{ old('jabatan', $suratTugas->jabatan) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="isi_surat" class="form-label">Isi Surat</label>
        <textarea name="isi_surat" id="isi_surat">{{$suratTugas->isi_surat}}</textarea>
    </div>
    <div class="mb-3">
        <label for="tanggal_tugas" class="form-label">Tanggal Tugas</label>
        <input type="date" id="tanggal_tugas" name="tanggal_tugas" placeholder="Tanggal Tugas" class="form-control"
            value="{{ old('tanggal_tugas', $suratTugas->tanggal_tugas) ??"-" }}">
    </div>
    <div class="mb-3">
        <label for="tempat_tugas" class="form-label">Tempat Tugas</label>
        <input type="text" id="tempat_tugas" name="tempat_tugas" placeholder="Tempat Tugas"
            class="form-control" value="{{ old('tempat_tugas', $suratTugas->tempat_tugas) ??"-" }}">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('suratTugas.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection