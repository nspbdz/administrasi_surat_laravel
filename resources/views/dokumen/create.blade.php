@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Dokumen</h1>
    </div>
</section>
<div class="modal-body">
    <form class="main-form" action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
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
            <input class="form-control @error('file_dok') is-invalid @enderror" type="file" id="file_dok" name="file_dok"
                onchange="previewFile()">
            @error('file_dok')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{route('dokumen.index')}}" class="btn btn-secondary">Batal</a>
    </form>
</div>


@endsection

@push('scripts')
<script>
    function previewFile() {
        const file_dok = document.querySelector('#file_dok');
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

