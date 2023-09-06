@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Data User</h1>
    </div>
    <div class="section-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th width="200px">Nama</th>
                        <th width="30px">:</th>
                        <th>{{ $user->name }}</th>
                    </tr>
                    <tr>
                        <th width="200px">Username</th>
                        <th width="30px">:</th>
                        <th>{{ $user->username }}</th>
                    </tr>
                    <!-- <tr>
                        <th width="200px">E-Mail</th>
                        <th width="30px">:</th>
                        <th>{{ $user->email }}</th>
                    </tr> -->
                    <!-- <tr>
                        <th width="200px">Password</th>
                        <th width="30px">:</th>
                        <th>{{ $user->password }}</th>
                    </tr> -->
                    <tr>
                        <th width="200px">Level</th>
                        <th width="30px">:</th>
                        <th>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                        @endif
                        </th>
                    </tr>
                </table>
            </div>
        </div>
        <tr>
            <th>
            <a class="btn btn-secondary" href="{{ route('users.index') }}"> Kembali</a>
            </th>
        </tr>
    </div>
</section>
@endsection
