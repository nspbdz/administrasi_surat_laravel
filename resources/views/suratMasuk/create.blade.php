@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Surat Masuk</h1>
    </div>
</section>
<div class="modal-body">
    <form class="main-form" action="{{ route('suratMasuk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Jenis Surat</label>
            <select name="jenis_surat" class="form-control" id="jenis_surat" class="form-control @error('jenis_surat') is-invalid @enderror" value="{{old('jenis_surat')}}">
                <option selected value="">--Pilih Jenis Surat--</option>
                <option value="pemberitahuan">Pemberitahuan</option>
                <option value="undangan">Undangan</option>
                <option value="izin">Perizinan</option>
            </select>
            @error('jenis_surat')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Nama Instansi</label>
            <select class="form-control" name="instansis_id" id="instansis" class="form-control @error('instansis_id') is-invalid @enderror" value="{{old('instansis_id')}}">
                <option value="">Nama Instansi</option>
                @foreach($instansi as $value)
                <option value="{{ $value->id }}" {{ old('instansis_id') == $value->id ? 'selected' : null }}> {{$value->nama_instansi}} </option>
                @endforeach
            </select>
            @error('instansis_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <input type="hidden" name="nmr_registrasi" placeholder="Nomor Registrasi" id="nmr_registrasi" class="form-control @error('nmr_registrasi') is-invalid @enderror">
            @error('nmr_registrasi')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" placeholder="Tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{old('tanggal')}}">
            @error('tanggal')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nomor Surat</label>
            <input type="text" name="no_surat" placeholder="Nomor Surat" class="form-control @error('no_surat') is-invalid @enderror" value="{{old('no_surat')}}">
            @error('no_surat')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Asal Surat</label>
            <input type="text" name="asal_surat" placeholder="Asal Surat" class="form-control @error('asal_surat') is-invalid @enderror" value="{{old('asal_surat')}}">
            @error('asal_surat')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Perihal</label>
            <input type="text" name="perihal" placeholder="Perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{old('perihal')}}">
            @error('perihal')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Penerima Surat</label>
            <input type="text" name="pnrm_surat" placeholder="Penerima surat" class="form-control @error('pnrm_surat') is-invalid @enderror" value="{{old('pnrm_surat')}}">
            @error('pnrm_surat')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Upload File</label>
            <input class="form-control @error('file_surat') is-invalid @enderror" type="file" id="file_surat" name="file_surat" onchange="previewFile()" value="{{old('file_surat')}}">
            @error('file_surat')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{route('suratMasuk.index')}}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

<script>
    function previewFile() {
        const file_surat = document.querySelector('#file_surat');
        const filePreview = document.querySelector('.file-preview');

        filePreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            filePreview.src = oFREvent.target.result;
        };
    }
</script>

@endsection

@push('scripts')
<script>
    $('#instansis').on('change', function(e) {
        var jenis_surat = $("#jenis_surat").val();
        var instansi = $("#instansis").val();
        console.log("klik");
        $.ajax({
            url: "{{route('registrationNumberSuratMasuk')}}",
            method: "GET",
            data: {
                "jenis_surat": jenis_surat,
                "instansis": instansi
            },
            success: function(data) {
                console.log(data);
                $('#nmr_registrasi').val(data);
            }
        })
    });
</script>

@endpush
