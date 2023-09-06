@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Data Instansi</h1>
    </div>
</section>
    <form class="main-form" action="{{ route('instansi.update', $instansi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Nama Instansi</label>
            <input name="nama_instansi" type="text" class="form-control" value="{{ old('nama_instansi', $instansi->nama_instansi) }}" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Cabang Instansi</label>
            <input type="text" name="cabang_instansi" class="form-control" value="{{ old('cabang_instansi', $instansi->cabang_instansi) }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nama Penanggung Jawab</label>
            <input type="text" name="nama_pj" class="form-control" value="{{ old('nama_pj', $instansi->nama_pj) }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $instansi->jabatan) }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" value="{{ old('nip', $instansi->nip) }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $instansi->alamat) }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nomor Telepone</label>
            <input type="text" name="nmr_telepon" class="form-control" value="{{ old('nmr_telepon', $instansi->nmr_telepon) }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Kode Instansi</label>
            <input type="text" name="kode_instansi" class="form-control" value="{{ old('kode_instansi', $instansi->kode_instansi) }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Masukan Logo</label>
                 @if($instansi->logo)
            <img src="{{asset('logoinstansi/' . $instansi->logo)}}" class="img-preview img-fluid d-block" style="width: 250px; height: 200px">
                 @else
            <img class="img-preview img-fluid">
                 @endif
            <input type="file" name="logo" class="form-control @error('image') is-invalid @enderror" id="logo" onchange="previewLogo()">
                 @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Masukan Tanda Tangan</label>
                 @if($instansi->tanda_tangan)
            <img src="{{asset('tanda_tanganinstansi/' . $instansi->tanda_tangan)}}" class="img-preview img-fluid d-block" style="width: 250px; height: 200px">
                 @else
            <img class="img-preview img-fluid">
                 @endif
            <input type="file" name="tanda_tangan" class="form-control @error('image') is-invalid @enderror" id="tanda_tangan" onchange="previewTanda_tangan()">
                 @error('tanda_tangan')
            <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Masukan Cap Surat</label>
                 @if($instansi->cap_surat)
            <img src="{{asset('cap_suratinstansi/' . $instansi->cap_surat)}}" class="img-preview img-fluid d-block" style="width: 250px; height: 200px">
                 @else
            <img class="img-preview img-fluid">
                 @endif
            <input type="file" name="cap_surat" class="form-control @error('image') is-invalid @enderror" id="cap_surat" onchange="previewCap_surat()">
                 @error('cap_surat')
            <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('instansi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

<script>
    function previewLogo(){
        const logo = document.querySelector('#logo');
        const logoPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(logo.files[0]);

        oFReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        };
    }

</script>

<script>
    function previewTanda_tangan(){
        const logo = document.querySelector('#tanda_tangan');
        const logoPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(logo.files[0]);

        oFReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        };
    }

</script>

<script>
    function previewCap_surat(){
        const logo = document.querySelector('#cap_surat');
        const logoPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(logo.files[0]);

        oFReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        };
    }

</script>

@endsection
