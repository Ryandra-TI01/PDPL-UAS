@extends('template')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Tipe Kamar</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
            <a class="text-decoration-none" href="/dashboard">/ Dashboard</a>
        </li>
    </ol>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('admin.tipe_kamar.create') }}" class="btn btn-primary mb-3">+ Pesanan</a>
    <table class ="table table-bordered">
        <tr class = "table-info">
            <th class="text-center align-middle">No.</th>
            <th class="text-center align-middle">Nama Kamar</th>
            <th class="text-center align-middle">Harga </th>
            <th class="text-center align-middle">Fasilitas</th>
            <th class="text-center align-middle">Gambar Kamar</th>
            <th class="text-center align-middle">Aksi</th>
        </tr>

        @foreach ( $tipe_kamars as $tipe_kamar )
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $tipe_kamar->nama_kamar}}</td>
            <td>{{ number_format($tipe_kamar->harga, 0, ',', '.') }}</td>
            <td>{{ Str::limit($tipe_kamar->fasilitas, 100) }}</td>
            <td><img src="{{ Storage::url($tipe_kamar->gambar_kamar) }}" alt="gambar" width="100" height="100"></td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('admin.tipe_kamar.edit',$tipe_kamar->id) }}" class="btn btn-warning me-3">Edit</a>
                <form action="{{ route('admin.tipe_kamar.destroy',$tipe_kamar->id) }}" method="POST">
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