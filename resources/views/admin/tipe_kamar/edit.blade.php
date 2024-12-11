@extends('template')
@section('content')
<div class="container-fluid px-4 mt-5">
    <h1 class="mt-4">Edit Tipe Kamar</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
            <a class="text-decoration-none" href="{{ route('admin.tipe_kamar') }}">/ Tipe Kamar</a>
        </li>
        <li class="breadcrumb-item ">
            <a class="text-decoration-none" href="/dashboard"> Dashboard</a>
        </li>
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
  <form action="{{ route('admin.tipe_kamar.update',$tipe_kamar->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_kamar" class="form-label">Nama Kamar</label>
        <input type="text" class="form-control" id="nama_kamar" name="nama_kamar" value="{{ $tipe_kamar->nama_kamar }}">
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="{{ $tipe_kamar->harga }}">
    </div>
    <div class="mb-3">
        <label for="fasilitas" class="form-label">Fasilitas</label>
        <textarea class="form-control" rows="5" id="fasilitas" name="fasilitas">{{ $tipe_kamar->fasilitas }}</textarea>
    </div>
    <div class="mb-3">
        <label for="gambar_kamar" class="form-label">Gambar Kamar :</label>
        @if ($tipe_kamar->gambar_kamar)
            <div class="mb-3">
                <img src="{{ Storage::url($tipe_kamar->gambar_kamar) }}" alt="Gambar Kamar" style="max-width: 200px;">
            </div>
        @endif
        <input class="form-control" type="file" id="gambar_kamar" name="gambar_kamar">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

</div>

@endsection