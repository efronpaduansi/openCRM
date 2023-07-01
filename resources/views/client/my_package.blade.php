@extends('layouts.backend.app')

@section('title', 'Paket Saya')
@section('content-header')
    <h1>Paket Saya</h1>
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
                            <th>Nama Pelanggan</th>
                            <th>Paket</th>
                            <th>Deskripsi Paket</th>
                            <th>Sub Total</th>
                            <th>Pajak</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tgl Berlangganan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($package as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->produk->nama_produk }}</td>
                                <td>{{ $item->produk->deskripsi }}</td>
                                <td>Rp. {{ number_format($item->produk->harga) }}</td>
                                <td>Rp. {{ number_format($item->produk->total_pajak) }}</td>
                                @php
                                    $total = $item->produk->harga + $item->produk->total_pajak;
                                @endphp
                                <td>Rp. {{ number_format($total ) }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>
                                   <div class="d-flex inline">
                                    <a href="{{ route('client.produk.req_upgrade') }}" class="btn btn-primary btn-sm mr-2" data-toggle="tooltip" data-placement="bottom" title="Upgrade"><i class="bi bi-cloud-plus-fill"></i></a>
                                    {{-- <a href="" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Perpanjang"><i class="bi bi-arrow-counterclockwise"></i></a> --}}
                                   </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection