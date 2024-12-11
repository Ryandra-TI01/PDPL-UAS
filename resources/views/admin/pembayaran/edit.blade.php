@extends('template')
@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-3">Edit Pembayaran</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="/dashboard-admin" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.pembayaran') }}" class="text-decoration-none">Pembayaran</a></li>
            <li class="breadcrumb-item">Edit Pembayaran</li>
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
        <form action="/admin/pembayaran/update/{{ $pembayaran->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label for="status_pembayaran" class="form-label">Status Pembayaran:</label>
                <select class="form-select" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="Belum Dibayar"  {{ $pembayaran->status_pembayaran == 'Belum Dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                    <option value="Menunggu Konfirmasi" {{ $pembayaran->status_pembayaran == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="Pembayaran Tidak Berhasil" {{ $pembayaran->status_pembayaran == 'Pembayaran Tidak Berhasil' ? 'selected' : '' }}>Pembayaran Tidak Berhasil</option>
                    <option value="Pembayaran Berhasil" {{ $pembayaran->status_pembayaran == 'Pembayaran Berhasil' ? 'selected' : '' }}>Pembayaran Berhasil</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="pemesanan_id" class="form-label">Pemesanan:</label>
                <input type="text" class="form-control" id="pemesanan_id" name="pemesanan_id" disabled value="{{ $pembayaran->pemesanan->user->name }} -- {{ $pembayaran->pemesanan->kamar->tipe_kamar->nama_kamar }} -- {{ $pembayaran->created_at }}" required>
                <p class="mt-3">Bukti Transfer :</p> 
                @if($pembayaran->bukti_transfer)
                <a href="{{ Storage::url($pembayaran->bukti_transfer) }}" target="_blank">Lihat Bukti Transfer</a>
                <img src="{{ Storage::url($pembayaran->bukti_transfer) }}" alt="Bukti Transfer" width="100%">
                @else
                    Belum ada bukti transfer
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
