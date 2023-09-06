@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Data User</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{ route('users.create') }}"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp; Tambah</a>
                    </div>
                    <div class="ml-auto p-3 bd-highlight">
                        <form action="" method="GET"></form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-md" id="users">
                        <thead>
                            <tr>
                                <th width="3%">No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
        swal("Data User berhasil di tambahkan!", {
            icon: "success",
        })
    })
</script>
@endif
@if(session('success-edit'))
<script>
    $(document).ready(function() {
        swal("Data User Berhasil di edit!", {
            icon: "success",
        })
    })
</script>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#users').DataTable({
            processing: true,
            serverside: true,
            // responsive: true,
            ajax: {
                url: "{{route('getUser')}}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        })
    });

    function deleteUser(id) {
        swal({
                title: "Yakin ?",
                text: "Anda akan menghapus Data User ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "users/" + id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            toastr.success('Data User dihapus', 'Berhasil')
                            table.draw()
                        },
                        error: function(err) {
                            toastr.error(
                                'Terjadi kesalahan saat menghapus Data User',
                                'Perhatian')
                        }
                    })
                    swal("Data User berhasil dihapus", {
                        icon: "success",
                    }).then(() => window.location.reload());
                } else {
                    swal("Data User tidak jadi dihapus");
                }
            });
    }
</script>
@endpush