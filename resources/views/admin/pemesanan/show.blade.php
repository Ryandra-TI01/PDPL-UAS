@extends('template')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Detail Pemesanan</title>
</head>
<body>
    <h1>Detail Pemesanan</h1>
    <p><strong>Check In:</strong> {{ $pemesanan->check_in }}</p>
    <p><strong>Check Out:</strong> {{ $pemesanan->check_out }}</p>
    <p><strong>Jumlah Tamu:</strong> {{ $pemesanan->jml_tamu }}</p>
    <p><strong>Kamar ID:</strong> {{ $pemesanan->kamar_id }}</p>
    <p><strong>Tamu ID:</strong> {{ $pemesanan->tamu_id }}</p>
    <a href="{{ route('pemesanan.edit', $pemesanan->id) }}">Edit</a>
    <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
    <a href="{{ route('pemesanan.index') }}">Kembali ke Daftar</a>
</body>
</html>

@endsection