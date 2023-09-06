@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-9 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary d-flex justify-content-center align-items-center">
                <a href="{{ route('suratPemberitahuan.index') }}"><i class="far fa-envelope" ></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Pemberitahuan</h4>
                    </div>
                    <div class="card-body">{{$pemberitahuan}}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-9 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger d-flex justify-content-center align-items-center">
                <a href="{{ route('suratTugas.index') }}"><i class="far fa-envelope" ></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Tugas</h4>
                    </div>
                    <div class="card-body">{{$tugas}}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-9 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success d-flex justify-content-center align-items-center">
                <a href="{{ route('suratDispensasi.index') }}"><i class="far fa-envelope" ></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Dispensasi</h4>
                    </div>
                    <div class="card-body">{{$dispensasi}}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-9 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning d-flex justify-content-center align-items-center">
                <a href="{{ route('suratUndangan.index') }}"><i class="far fa-envelope" ></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Undangan</h4>
                    </div>
                    <div class="card-body">{{$undangan}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-header">
        <h1>Daftar Jadwal Surat</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                        <table class="table table-bordered table-md" id="dokumen">
                            <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Jenis Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dokumen').DataTable({
            processing: true,
            serverside: true,
            // responsive: true,
            ajax: {
                url: "{{route('getDashboard')}}"
            },

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'nama_keg',
                    name: 'nama_keg'
                },
                {
                    data: 'jenis_surat',
                    name: 'jenis_surat'
                }
            ]
        })
    });

</script>

@endpush
