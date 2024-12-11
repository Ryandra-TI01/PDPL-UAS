@extends('template')
@section('content')

    <div class="container-fluid px-4 mt-5">
        <h1 class="mt-3">Edit Pemesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="/dashboard-admin" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.pemesanan') }}" class="text-decoration-none">Pemesanan</a></li>
            <li class="breadcrumb-item">Edit data Pemesanan</li>
        </ol>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group row mb-3">
            <label for="check_in" class="col-md-4 col-form-label text-md-right">Tanggal Check In</label> 
            <div class="col-md-6">
              <input id="check_in" name="check_in" type="date" class="form-control" value="{{ $pemesanan->check_in }}">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="check_out" class="col-md-4 col-form-label text-md-right">Tanggal Check Out</label> 
            <div class="col-md-6">
              <input id="check_out" name="check_out" type="date" class="form-control" value="{{ $pemesanan->check_out }}">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="jml_tamu" class="col-md-4 col-form-label text-md-right">Jumlah Tamu</label> 
            <div class="col-md-6">
              <input id="jml_tamu" name="jml_tamu" placeholder="Jumlah Tamu" type="text" class="form-control" value="{{ $pemesanan->jml_tamu }}">
            </div>
        </div> 
        <div class="form-group row mb-3">
            <label for="kamar_id" class="col-md-4 col-form-label text-md-right">Kamar</label> 
            <div class="col-md-6">
              <select class="form-select" aria-label="Default select example" name="kamar_id">
                @foreach ($kamar as $kamarItem)
                  @if ($kamarItem->status == 'Tersedia' || $kamarItem->id == $pemesanan->kamar_id)
                  <option value="{{ $kamarItem->id }}" {{ $kamarItem->id == $pemesanan->kamar_id ? 'selected' : '' }}>
                    Kamar No {{ $kamarItem->no_kamar }} -- {{ $kamarItem->tipe_kamar->nama_kamar }}
                  </option>
                  @endif
                @endforeach
              </select>                
            </div>
        </div> 
        <div class="form-group row mb-3">
            <label for="user_id" class="col-md-4 col-form-label text-md-right">Tamu</label> 
            <div class="col-md-6">
              <select class="form-select" aria-label="Default select example" name="user_id">
                @foreach ($users as $user)
                  <option value="{{ $user->id }}" {{ $user->id == $pemesanan->user_id ? 'selected' : '' }}>
                    {{ $user->name }}
                  </option>
                @endforeach
              </select>
            </div>
        </div> 
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
              <button name="submit" type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>

        </form>
    </div>
@endsection
