@extends('template')
@section('content')
<div class="container-fluid px-4">
    <h1>Daftar Pemesanan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">/ <a href="/dashboard-admin" class="text-decoration-none">Pemesanan</a></li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Pemesanan
        </div>
        <div class="card-body">
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>id</th>
                <th>User</th>
                <th>Kamar</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Total Harga</th>
                <th>Per Malam</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>id</th>
                <th>User</th>
                <th>Kamar</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Total Harga</th>
                <th>Per Malam</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($list_pemesanan as $pemesanan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pemesanan->user->name  }}</td>
                <td>Kamar Nomor {{ $pemesanan->kamar->no_kamar }}--{{$pemesanan->kamar->tipe_kamar->nama_kamar}}</td>
                <td>{{ $pemesanan->check_in  }}</td>
                <td>{{ $pemesanan->check_out }}</td>
                <td>{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                <td>{{ $pemesanan->malam }} Malam</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection
