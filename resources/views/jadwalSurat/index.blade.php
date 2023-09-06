@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Jadwal Surat</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        @can('jadwal_surat-create')
                        <a href="{{route('jadwalSurat.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp;Tambah</a>
                        @endcan
                        <div class="ml-auto p-3 bd-highlight">
                            <form action="" method="GET"></form>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                        <table class="table table-bordered table-md" id="jadwal">
                            <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Jenis Surat</th>
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
        swal("Jadwal Surat berhasil di tambahkan!", {
            icon: "success",
        })
    })
</script>
@endif
@if(session('success-edit'))
<script>
    $(document).ready(function() {
        swal("Jadwal Surat Berhasil di edit!", {
            icon: "success",
        })
    })
</script>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#jadwal').DataTable({
            processing: true,
            serverside: true,
            // responsive: true,
            ajax: {
                url: "{{route('getJadwalSurat')}}"
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
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        })
    });

    function deleteJadwalSurat(id) {
        swal({
                title: "Yakin ?",
                text: "Anda akan menghapus Jadwal Surat ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/jadwalSurat/" + id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            toastr.success('Jadwal Surat dihapus', 'Berhasil')
                            table.draw()
                        },
                        error: function(err) {
                            toastr.error(
                                'Terjadi kesalahan saat menghapus Jadwal Surat',
                                'Perhatian')
                        }
                    })
                    swal("Jadwal Surat berhasil dihapus", {
                        icon: "success",
                    }).then(() => window.location.reload());
                } else {
                    swal("Jadwal Surat tidak jadi dihapus");
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
