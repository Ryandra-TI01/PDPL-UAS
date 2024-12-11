<!-- resources/views/pembayaran/checkout.blade.php -->
@extends('welcome')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Detail Pembayaran</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Pelanggan</th>
                                <td>{{ $pemesanan->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email Pelanggan</th>
                                <td>{{ $pemesanan->user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Kamar</th>
                                <td>{{ $pemesanan->kamar->tipe_kamar->nama_kamar }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nomor Kamar</th>
                                <td>No. {{ $pemesanan->kamar->no_kamar }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Check-in</th>
                                <td>{{ \Carbon\Carbon::parse($pemesanan->check_in)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Check-out</th>
                                <td>{{ \Carbon\Carbon::parse($pemesanan->check_out)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Malam</th>
                                <td>{{ $pemesanan->malam }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Pemesanan</th>
                                <td>{{ $pemesanan->kode_pesanan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total Harga</th>
                                <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
