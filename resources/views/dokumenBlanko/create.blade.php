@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Dokumen Blanko</h1>
    </div>
</section>
<div class="modal-body">
    <form class="main-form" action="{{ route('dokumenBlanko.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="" class="form-label">Nama Dokumen</label>
            <input type="text" name="nama_dok" placeholder="Nama Dokumen"
                class="form-control @error('nama_dok') is-invalid @enderror" value="{{ old('nama_dok') }}">
            @error('nama_dok')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Upload File</label>
            <input class="form-control @error('file_doct') is-invalid @enderror" type="file" id="file_doct" name="file_doct"
                onchange="previewFile()">
            @error('file_doct')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{route('dokumenBlanko.index')}}" class="btn btn-secondary">Batal</a>
    </form>
</div>


@endsection

@push('scripts')
<script>
    function previewFile() {
        const file_doct = document.querySelector('#file_doct');
        const filePreview = document.querySelector('.file-preview');

        filePreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            filePreview.src = oFREvent.target.result;
        };
    }

</script>
@endpush

