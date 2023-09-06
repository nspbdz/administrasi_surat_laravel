@extends('layouts.main')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Jadwal Surat </h2>
        </div>
        <div class="pull-right">
            @can('product-create')
            <a class="btn btn-success" href="{{ route('jadwal.create') }}"> Tambah </a>
            @endcan
        </div>
    </div>
</div>


<!-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif -->


<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #6777ef;
        color: white;
    }
</style>

<table class="table table-bordered" id="customers">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Details</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->detail }}</td>
        <td>
            <form action="{{ route('jadwal.destroy',$product->id) }}" method="POST">
                <!-- <a class="btn btn-info" href="{{ route('jadwal.show',$product->id) }}">Show</a> -->
                <!-- @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('jadwal.edit',$product->id) }}">Edit</a>
                    @endcan -->


                <!-- @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan -->
            </form>
        </td>
    </tr>
    @endforeach
</table>


{!! $products->links() !!}


<p class="text-center text-primary"><small> </small></p>
@endsection
