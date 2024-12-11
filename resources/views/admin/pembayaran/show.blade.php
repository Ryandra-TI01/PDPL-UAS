@extends('template')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Detail Pembayaran</title>
</head>
<body>
    <h1>Detail Pembayaran</h1>
    <p><strong>Status Pembayaran:</strong> {{ $pembayaran->status_pembayaran }}</p>
    <p><strong>ID Pemesanan:</strong> {{ $pembayaran->pemesanan_id }}</p>
    <a href="{{ route('admin.pembayaran.edit', $pembayaran->id) }}">Edit</a>
    <form action="{{ route('admin.pembayaran.destroy', $pembayaran->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
    <a href="{{ route('admin.pembayaran.index') }}">Kembali ke Daftar</a>
</body>
</html>
@endsection
