@extends('layouts.frontend.app')

@section('title', 'Welcome to HH Net')

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero">

    <div class="container">
      <div class="row d-flex align-items-center"">
      <div class=" col-lg-6 py-5 py-lg-0 order-2 order-lg-1" data-aos="fade-right">
        <h1>Solusi Internet Terbaik</h1>
        <h2>Kami memberikan pelayanan yang pas dengan kebutuhanmu.</h2>
        <a href="{{ route('pricing') }}" class="btn-get-started scrollto">Pilih paket sekarang</a>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
        <img src="{{ asset('website/img/hero-img.png') }}" class="img-fluid" alt="">
      </div>
    </div>
    </div>

  </section>
  <!-- End Hero -->

  <main id="main">
  </main>
  <!-- End #main -->
    
@endsection
    