@extends('template')

@section('content')
<div class="container-fluid px-4 mt-5">
    <h1 class="mt-3">Create Pembayaran</h1>
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
    <form action="{{ route('admin.pembayaran.store') }}" method="post">
        @csrf
        <div class="form-group row mb-3">
            <label for="status_pembayaran" class="col-4 col-form-label">Status Pembayaran</label> 
            <div class="col-8">
                <select id="status_pembayaran" name="status_pembayaran" class="form-control">
                    <option selected disabled>-- Pilih Status --</option>
                    <option value="Belum Dibayar">Belum Dibayar</option>
                    <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                    <option value="Pembayaran Tidak Berhasil">Pembayaran Tidak Berhasil</option>
                    <option value="Pembayaran Berhasil">Pembayaran Berhasil</option>
                </select>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="pemesanan_id" class="col-4 col-form-label">Pemesanan</label> 
            <div class="col-8">
                <select id="pemesanan_id" name="pemesanan_id" class="form-control" required>
                    <option selected disabled>-- Pilih Pemesanan --</option>
                    @foreach ($pemesanan as $pemesanan)
                    <option value="{{ $pemesanan->id }}">{{ $pemesanan->user->name }} -- Kamar No {{ $pemesanan->kamar->no_kamar }} -- {{ $pemesanan->kamar->tipe_kamar->nama_kamar }} -- {{  $pemesanan->created_at->format('l, F j, Y') }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="formFile" class="col-4 form-label">Bukti Transfer</label>
            <div class="col-8">
                <input class="form-control" type="file" id="formFile" name="bukti_transfer">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
