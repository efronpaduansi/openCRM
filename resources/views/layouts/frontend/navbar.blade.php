<!-- ======= Header ======= -->
<header id="header">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="{{ route('welcome') }}">HH Net<span>.</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto {{ (request()->is('/')) ? 'active' : '' }}" href="{{ route('welcome') }}">Home</a></li>
          <li><a class="nav-link scrollto {{ (request()->is('pricing')) ? 'active' : '' }}" href="{{ route('pricing') }}">Paket Internet</a></li>
          <li><a class="nav-link scrollto {{ (request()->is('contact')) ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a></li>
          <li><a class="getstarted scrollto" href="{{ route('auth.login') }}">Masuk</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->