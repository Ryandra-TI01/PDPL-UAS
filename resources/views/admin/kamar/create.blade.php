@extends('template')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-3">Create kamar</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="/dashboard-admin" class="text-decoration-none">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.kamar') }}" class="text-decoration-none">kamar</a></li>
        <li class="breadcrumb-item">Create kamar</li>
    </ol>
    @if (count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.kamar.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="no_kamar" class="form-label">No Kamar</label>
            <input type="number" class="form-control" id="no_kamar" name="no_kamar" >
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" aria-label="Default select example" name="status">
                <option value="Tersedia">Tersedia</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
            <select class="form-select" aria-label="Default select example" name="id_tipe_kamar">
                @foreach ($tipe_kamars as $tipe_kamar)
                    <option value="{{ $tipe_kamar->id }}">{{ $tipe_kamar->nama_kamar }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    
</div>
@endsection