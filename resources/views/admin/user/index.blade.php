@extends('template')
@section('content')
<div class="container-fluid px-4">
    <h1>Daftar User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">/ <a href="/dashboard-admin" class="text-decoration-none">Dashboard</a></li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable User
        </div>
        <div class="card-body">
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>No. Tlp</th>
                <th>Asal Kota</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>No. Tlp</th>
                <th>Asal Kota</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($list_user as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->no_tlp }}</td>
                <td>{{ $user->asal_kota }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection
