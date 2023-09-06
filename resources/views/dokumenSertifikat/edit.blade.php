@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Dokumen Sertifikat</h1>
    </div>
</section>
    <form class="main-form" action="{{ route('dokumenSertifikat.update', $dokumenSertifikat->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" placeholder="Tanggal" class="form-control"
                value="{{old('tanggal', $dokumenSertifikat->tanggal)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nama Dokumen</label>
            <input type="text" name="nama_dok" placeholder="Nama Dokumen" class="form-control"
                value="{{old('nama_dok', $dokumenSertifikat->nama_dok)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nama File </label>
            <input type="text" name="file_dok" class="form-control" value="{{old('file_dok', $dokumenSertifikat->file_dok)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Upload File</label>
            <input type="file" name="file_dok" placeholder="Upload File" class="form-control"
                value="{{old('file_dok', $dokumenSertifikat->file_dok)}}">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{route('dokumenSertifikat.index')}}" class="btn btn-secondary">Kembali</a>
    </form>

@endsection

