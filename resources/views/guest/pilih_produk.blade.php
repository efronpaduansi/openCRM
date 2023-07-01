@extends('layouts.backend.app')

@section('title', 'Produk')

@section('content-header')
    <h1>Pilih Produk</h1>
@endsection

@section('content')
    <div class="row">
        @foreach ($produk as $p)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('uploads/' . $p->gambar) }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <h5 class="text-center">{{ $p->nama_produk }}</h5>
                  <p class="card-text">{{ $p->deskripsi }}</p>
                  <h3 class="font-weight-bold my-4">Rp. {{ $p->harga }} <sub>/month</sub></h3>
                  <a href="{{ route('pendaftaran.create', $p->id) }}" class="btn btn-primary text-center">Checkout</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection