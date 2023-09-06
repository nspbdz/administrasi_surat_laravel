@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Surat Dispensasi</h1>
    </div>
</section>
<form class="main-form" action="{{route('suratDispensasi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Jenis Surat</label>
        <select name="jenis_surat" class="form-control" id="jenis_surat" class="form-control @error('jenis_surat') is-invalid @enderror" value="{{old('jenis_surat')}}">
            <option selected value="">--Pilih Jenis Surat--</option>
            <option value="Surat Dispensasi">Surat Dispensasi</option>
        </select>
        @error('jenis_surat')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <input type="hidden" name="no_surat" placeholder="Nomor Surat" id="no_surat" class="form-control @error('no_surat') is-invalid @enderror">
        @error('no_surat')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Kode Instansi</label>
        <select name="kode_instansi" class="form-control @error('kode_instansi') is-invalid @enderror" value="{{ old('kode_instansi') }}" id="kode_instansi">
            <option value="">Kode Instansi</option>
            @foreach ($instansis as $value)
            <option value="{{ $value->id }}" {{ old('kode_instansi') == $value->id ? 'selected' : null }}> {{$value->kode_instansi}} </option>
            @endforeach
        </select>
        @error('kode_instansi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3" id="tempat_surat">
        <label for="" class="form-label">Tempat</label>
        <input type="text" name="tempat_surat" placeholder="Tempat Surat" class="form-control @error('tempat_surat') is-invalid @enderror" value="{{ old('tempat_surat') }}">
        @error('tempat_surat')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3" id="tanggal_surat">
        <label for="" class="form-label">Tanggal Surat</label>
        <input type="date" name="tanggal_surat" placeholder="Tanggal Surat" class="form-control @error('tanggal_surat') is-invalid @enderror" value="{{ old('tanggal_surat') }}">
        @error('tanggal_surat')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3" id="nama_siswa">
        <label for="" class="form-label">Nama Siswa</label>
        <input type="text" name="nama_siswa" placeholder="Nama Siswa" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" value="{{ old('nama_siswa') }}">
        @error('nama_siswa')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3" id="asal_mdta">
        <label for="" class="form-label">Asal Madrasah</label>
        <input type="text" name="asal_mdta" placeholder="Asal Madrasah" class="form-control @error('asal_mdta') is-invalid @enderror" value="{{ old('asal_mdta') }}">
        @error('asal_mdta')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="isi_surat" class="form-label">Isi Surat</label>
        <input type="hidden">
        <textarea name="isi_surat" id="isi_surat"></textarea>
    </div>
    <div class="mb-3" id="tanggal_dispensasi">
        <label for="" class="form-label">Tanggal Dispensasi</label>
        <input type="date" name="tanggal_dispensasi" placeholder="Tanggal Dispensasi" class="form-control @error('tanggal_dispensasi') is-invalid @enderror" value="{{ old('tanggal_dispensasi') }}">
        @error('tanggal_dispensasi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3" id="tempat_dispensasi">
        <label for="" class="form-label">Tempat Dispensasi</label>
        <input type="text" name="tempat_dispensasi" placeholder="Tempat Dispensasi" class="form-control @error('tempat_dispensasi') is-invalid @enderror" value="{{ old('tempat_dispensasi') }}">
        @error('tempat_dispensasi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label"> Tanda Tangan</label>
        <input disabled id="nama_pj" type="text" name="nama_pj" placeholder="Tanda Tangan" class="form-control @error('nama_pj') is-invalid @enderror" value="{{ old('nama_pj') }}">
    </div>

    <button type="submit" class="btn btn-primary">Tambah</button>
    <a href="{{ route('suratDispensasi.index') }}" class="btn btn-secondary">Batal</a>
</form>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->

@endsection

@push('scripts')

<script>
    $('#kode_instansi').on('change', function(e) {

        // console.log($('#kode_instansi').val());
        instansi_id = $('#kode_instansi').val();

        $('#nama_pj').val(instansi_id);

        $.ajax({
            url: "{{route('generateLetterNumberDispensasi')}}",
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                jenis_surat: $('#jenis_surat').val(),
                kode_instansi: $('#kode_instansi').val(),
            },
            success: function(res) {
                // console.log(res);
                $('#no_surat').val(res.letterNumber)
                $('#nama_pj').val(res.nama_pj);
            }
        })
    });
</script>

@endpush
