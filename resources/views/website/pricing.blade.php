@extends('layouts.frontend.app')

@section('title', 'Paket Internet')

@section('content')

 <!-- ======= Pricing Section ======= -->
 <section id="pricing" class="pricing section-bg">
    <div class="container">

      <div class="section-title">
        <h2 data-aos="fade-in">Pricing</h2>
        <p data-aos="fade-in">Pilih paket sesuai kebutuhanmu. Dapatkan promo menarik sekarang juga!</p>
      </div>

      <div class="row no-gutters">
        @foreach ($produks as $produk) 
          <div class="col-lg-4 box" data-aos="zoom-in">
            <img src="{{ asset('uploads/' . $produk->gambar) }}" alt="gambar" height="220px">
            <h3>{{ $produk->nama_produk }}</h3>
            <h4>{{ $produk->harga }}<span>per month</span></h4>
            <ul>
              <li><i class="bx bx-check"></i> {{ $produk->deskripsi }}</li>
            </ul>
            <a href="{{ route('auth.register') }}" class="get-started-btn">Pilih paket</a>
          </div>
        @endforeach

        {{-- <div class="col-lg-4 box featured" data-aos="zoom-in">
          <span class="featured-badge">Featured</span>
          <h3>Business</h3>
          <h4>$29<span>per month</span></h4>
          <ul>
            <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
            <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
            <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
            <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
            <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
          </ul>
          <a href="#" class="get-started-btn">Get Started</a>
        </div>

        <div class="col-lg-4 box" data-aos="zoom-in">
          <h3>Developer</h3>
          <h4>$49<span>per month</span></h4>
          <ul>
            <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
            <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
            <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
            <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
            <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
          </ul>
          <a href="#" class="get-started-btn">Get Started</a>
        </div> --}}

      </div>

    </div>
  </section>
  <!-- End Pricing Section -->

@endsection