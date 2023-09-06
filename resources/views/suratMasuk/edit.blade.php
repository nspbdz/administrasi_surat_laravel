@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Surat Masuk</h1>
    </div>
</section>
<div class="modal-body">
    <form class="main-form" action="{{ route('suratMasuk.update', $suratMasuk->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Jenis Surat</label>
            <input type="" name="jenis_surat" class="form-control"
                value="{{old('jenis_surat', $suratMasuk->jenis_surat)}}">
        </div>
        @if ($suratMasuk->instansis)
        <div class="mb-3">
            <label for="">Nama Instansi</label>
            <select class="form-control" name="instansis_id">
                <option>Nama Instansi</option>
                    @foreach($instansis as $value)
                    @if(old('instansis_id', $value->instansis_id) == $value->instansis_id)
                        <option value="{{ $value->id }}" selected> {{$value->nama_instansi}} </option>
                    @else
                        <option value="{{ $value->id }}"> {{$value->nama_instansi}} </option>
                    @endif
                    @endforeach
            </select>
        </div>
        @endif
        <div class="mb-3">
            <label for="" class="form-label">Nomor Registrasi</label>
            <input type="hidden"  name="nmr_registrasi" placeholder="Nomor Registrasi" class="form-control"
                value="{{old('nmr_registrasi', $suratMasuk->nmr_registrasi)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" placeholder="Tanggal" class="form-control"
                value="{{old('tanggal', $suratMasuk->tanggal)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nomor Surat</label>
            <input type="text" name="no_surat" placeholder="Nomor Surat" class="form-control"
                value="{{old('no_surat', $suratMasuk->no_surat)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Asal Surat</label>
            <input type="text" name="asal_surat" placeholder="Asal Surat" class="form-control"
                value="{{old('asal_surat', $suratMasuk->asal_surat)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Perihal</label>
            <input type="text" name="perihal" placeholder="Perihal" class="form-control"
                value="{{old('perihal', $suratMasuk->perihal)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Penerima Surat</label>
            <input type="text" name="pnrm_surat" placeholder="Penerima surat" class="form-control"
                value="{{old('pnrm_surat', $suratMasuk->pnrm_surat)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nama File </label>
            <input type="text" name="file_surat" class="form-control" value="{{old('file_surat', $suratMasuk->file_surat)}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Upload File</label>
            <input type="file" name="file_surat" placeholder="Upload File" class="form-control"
                value="{{old('file_surat', $suratMasuk->file_surat)}}">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{route('suratMasuk.index')}}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection



