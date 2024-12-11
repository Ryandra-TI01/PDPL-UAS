@extends('template')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-3">kamar</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">/ <a href="/dashboard-admin" class="text-decoration-none">Dashboard</a></li>
    </ol>
    <a href="{{ route('admin.kamar.create') }}" class="btn btn-primary mb-3">+ kamar</a>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table class ="table table-bordered">
        <tr class = "table-info">
            <th class="text-center align-middle">No.</th>
            <th class="text-center align-middle">No Kamar</th>
            <th class="text-center align-middle">Status</th>
            <th class="text-center align-middle">Tipe Kamar</th>
            <th class="text-center align-middle">Aksi</th>
        </tr>

        @foreach ( $kamars as $kamar )
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $kamar->no_kamar}}</td>
            <td>{{ $kamar->status}}</td>
            <td>{{ $kamar->tipe_kamar->nama_kamar}}</td>
            <td class="d-flex">
                <a href="{{ route('admin.kamar.edit',$kamar->id) }}" class="btn btn-warning me-3">Edit</a>
                <form action="{{ route('admin.kamar.destroy',$kamar->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>


@endsection