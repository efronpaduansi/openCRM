@extends('layouts.backend.app')

@section('title', 'Daftar Produk')

@section('content-header')
    <h1>Daftar Produk</h1>
@endsection

@section('content')
    <div class="row">
        @foreach ($produks as $p)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('uploads/' . $p->gambar) }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <h5 class="text-center">{{ $p->nama_produk }}</h5>
                  <p class="card-text">{{ $p->deskripsi }}</p>
                  <h3 class="font-weight-bold my-4">Rp. {{ $p->harga }} <sub>/month</sub></h3>
                  <a href="{{ route('client.produk.send_req_upgrade', $p->id) }}" class="btn btn-primary text-center">Checkout</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif
@endsection