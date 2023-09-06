@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Instansi</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        @can('instansi-create')
                        <a href="{{route('instansi.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp;Tambah</a>
                        @endcan
                        <div class="ml-auto p-3 bd-highlight">
                            <form action="" method="GET"></form>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                        <table class="table table-bordered table-md" id="instansi">
                            <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Nama Instansi</th>
                                    <th>Cabang Instansi</th>
                                    <th>Kode Instansi</th>
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
        swal("Data Instansi Berhasil di tambahkan!", {
            icon: "success",
        })
    })
</script>
@endif
@if(session('success-edit'))
<script>
    $(document).ready(function() {
        swal("Data Instansi Berhasil di edit!", {
            icon: "success",
        })
    })
</script>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#instansi').DataTable({
            processing: true,
            serverside: true,
            // responsive: true,
            ajax: {
                url: "{{route('getInstansi')}}"
            },

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_instansi',
                    name: 'nama_instansi'
                },
                {
                    data: 'cabang_instansi',
                    name: 'cabang_instansi'
                },
                {
                    data: 'kode_instansi',
                    name: 'kode_instansi'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        })
    });

    function deleteInstansi(id) {
        swal({
                title: "Yakin ?",
                text: "Anda akan menghapus Data Instansi ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/instansi/" + id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            toastr.success('Data Instansi dihapus', 'Berhasil')
                            table.draw()
                        },
                        error: function(err) {
                            toastr.error(
                                'Terjadi kesalahan saat menghapus Data Instansi',
                                'Perhatian')
                        }
                    })
                    swal("Data Instansi berhasil dihapus", {
                        icon: "success",
                    }).then(() => window.location.reload());
                } else {
                    swal("Data Instansi tidak jadi dihapus");
                }
            });
    }

    // @if(session('success'))
    //     swal({
    //         icon: 'success',
    //         title: `{{ session('success') }}`
    //     })
    //     @endif

    //     @if(session('error'))
    //     swal({
    //         icon: 'error',
    //         title: `{{ session('error') }}`,
    //         text: `{{ request()->session()->has('error_message')? session('error_message'): null }}`
    //     })
    //     @endif
</script>

@endpush
