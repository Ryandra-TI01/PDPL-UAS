@extends('template')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Pembayaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pembayaran</li>
    </ol>
    {{-- <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary mb-3">+ Pembayaran</a> --}}
    <table class="table table-bordered">
        <tr class="table-info">
            <th class="text-center align-middle">No.</th>
            <th class="text-center align-middle">Status Pembayaran</th>
            <th class="text-center align-middle">Pemesanan</th>
            <th class="text-center align-middle">Bukti Transfer</th>
            <th class="text-center align-middle">Aksi</th>
        </tr>

        @foreach ($pembayaran as $pembayaran)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pembayaran->status_pembayaran }}</td>
            <td>{{ $pembayaran->pemesanan->user->name }} -- {{ $pembayaran->pemesanan->kamar->tipe_kamar->nama_kamar }} -- {{ $pembayaran->created_at }}</td>
            <td class="text-center">
                @if($pembayaran->bukti_transfer)
                    <img src="{{ Storage::url($pembayaran->bukti_transfer) }}" alt="Bukti Transfer" width="100" height="100">
                @else
                    Belum ada bukti transfer
                @endif
            </td>
            <td class="d-flex justify-content-around">
                <a href="/admin/pembayaran/edit/{{$pembayaran->id }}" class="btn btn-warning">Edit</a>
                <form action="/admin/pembayaran/delete/{{$pembayaran->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
