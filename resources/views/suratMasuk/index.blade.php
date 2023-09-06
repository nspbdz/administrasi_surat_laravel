@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Surat Masuk</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        @can('surat_masuk-create')
                        <a href="{{route('suratMasuk.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp;Tambah</a>
                        @endcan
                    </div>
                    <div class="card-body pb-0">
                        <form action="#" id="filterPrice">
                            <div class="row">
                                <div class="col-xl-3 col-md-3 col-12">
                                    <label class="form-label" for="">Tanggal Awal</label>
                                    <input type="date" data-date-format="yyyy-MM-dd" class="form-control" name="awal" id="awal">
                                </div>
                                <div class="col-xl-3 col-md-3 col-12">
                                    <label class="form-label" for="">Tanggal Akhir</label>
                                    <input type="date" data-date-format="yyyy-MM-dd" class="form-control" name="akhir" id="akhir">
                                </div>
                                <div class="d-flex col-xl-3 col-md-3 align-items-center mt-4 gap-2">
                                    <button type="button" class="btn btn-primary" id="btnFilter"><i data-feather='filter'></i>&nbsp;Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                        <table class="table table-bordered" id="suratMasuk">
                            <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th>No. Registrasi</th>
                                    <th>Nama Instansi</th>
                                    <th>Tanggal</th>
                                    <th>Asal Surat</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
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
@if(session('success'))
<script>
    $(document).ready(function() {
        swal("Surat Masuk berhasil di tambahkan!", {
            icon: "success",
        })
    })
</script>
@endif
@if(session('success-edit'))
<script>
    $(document).ready(function() {
        swal("Surat Masuk Berhasil di edit!", {
            icon: "success",
        })
    })
</script>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let suratMasuk = $('#suratMasuk').DataTable({
            processing: true,
            serverside: true,
            // responsive: true,
            ajax: {
                url: "{{route('getSuratMasuk')}}",
                data: function(data) {
                    data.awal = $('#awal').val();
                    data.akhir = $('#akhir').val();
                },
            },

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nmr_registrasi',
                    name: 'nmr_registrasi'
                },
                {
                    data: 'instansis',
                    name: 'instansi.nama_instansi'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'asal_surat',
                    name: 'asal_surat'
                },
                {
                    data: 'jenis_surat',
                    name: 'jenis_surat'
                },
                {
                    data: 'status_badges',
                    name: 'status_badges'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        })

        $('#btnFilter').click(function(e) {
            e.preventDefault()
            suratMasuk.ajax.reload();
        })
    });


    function deleteSuratMasuk(id) {
        swal({
                title: "Yakin ?",
                text: "Anda akan menghapus Surat Masuk ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/suratMasuk/" + id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            toastr.success('Surat Masuk berhasil dihapus', 'Berhasil')
                            table.draw()
                        },
                        error: function(err) {
                            toastr.error(
                                'Terjadi kesalahan saat menghapus Surat Masuk',
                                'Perhatian')
                        }
                    })
                    swal("Surat Masuk berhasil dihapus", {
                        icon: "success",
                    }).then(() => window.location.reload());
                } else {
                    swal("Surat Masuk tidak jadi dihapus");
                }
            });
    }

    // @if(session('success'))
    // swal({
    //     icon: 'success',
    //     title: `{{ session('success') }}`
    // })
    // @endif

    // @if(session('error'))
    // swal({
    //     icon: 'error',
    //     title: `{{ session('error') }}`,
    //     text: `{{ request()->session()->has('error_message')? session('error_message'): null }}`
    // })
    // @endif

    function status(id) {
        $.ajax({
            url: "{{url('status')}}" + '/' + id,
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(res) {
                $('#status').val(res)
            }
        })
        window.location.replace("{{route('suratMasuk.index')}}");
    };

    function statusundo(id) {
        $.ajax({
            url: "{{url('statusundo')}}" + '/' + id,
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(res) {
                $('#statusundo').val(res)
            }
        })
        window.location.replace("{{route('suratMasuk.index')}}");
    };
</script>

@endpush
