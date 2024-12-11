@extends('template')
@section('content')
<div class="container-fluid px-4 mt-5">
  @if (count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif
    <form action="{{ route('admin.pemesanan.store') }}" method="POST">
      @csrf
        <div class="form-group row mb-3">
            <label for="check_in" class="col-md-4 col-form-label text-md-right">Tanggal Check In</label> 
            <div class="col-md-6">
              <input id="check_in" name="check_in" type="date" class="form-control">
            </div>
          </div>
          <div class="form-group row mb-3">
            <label for="check_out" class="col-md-4 col-form-label text-md-right">Tanggal Check Out</label> 
            <div class="col-md-6">
              <input id="check_out" name="check_out" type="date" class="form-control">
            </div>
          </div>
          <div class="form-group row mb-3">
            <label for="jml_tamu" class="col-md-4 col-form-label text-md-right">Jumlah Tamu</label> 
            <div class="col-md-6">
              <input id="jml_tamu" name="jml_tamu" placeholder="Jumlah Tamu" type="text" class="form-control">
            </div>
          </div> 
          <div class="form-group row mb-3">
            <label for="kamar_id" class="col-md-4 col-form-label text-md-right">Kamar</label> 
            <div class="col-md-6">
              <select class="form-select" aria-label="Default select example" name="kamar_id">
                @foreach ($kamar as $kamar)
                  @if ($kamar->status == 'Tersedia')
                  <option value="{{ $kamar->id }}">Kamar No {{ $kamar->no_kamar }}  -- {{ $kamar->tipe_kamar->nama_kamar }}</option>
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
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div> 
          <div class="form-group row">
            <div class="col-md-6 offset-md-4">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
    </form>
</div>
@endsection
