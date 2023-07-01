@extends('layouts.backend.app')

@section('title', 'Customers')
@section('content-header')
    <h1>Daftar Customers</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Status</th>
                            <th>Tgl Exp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->fullname }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->city }}</td>
                                <td>{{ $customer->province }}</td>
                                <td>
                                    @if ($customer->status == 'Active')
                                        <span class="badge badge-success">{{ $customer->status }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $customer->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $customer->exp_date }}</td>
                                <td>
                                    <form action="{{ route('admin.customers.disable', $customer->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Aktif/Nonaktifkan" onclick="return confirm('Anda yakin?')">
                                            @if ($customer->status == 'Active')
                                            <i class="bi bi-lock-fill"></i>
                                        @else
                                            <i class="bi bi-unlock-fill"></i>
                                        @endif
                                        </button>
                                    </form>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Tampilkan pesan --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection