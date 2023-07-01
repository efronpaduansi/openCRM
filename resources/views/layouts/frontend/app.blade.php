
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
    @yield('title')
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('layouts.frontend.styles')
  <!-- =======================================================
  * Template Name: Bocor - v4.10.0
  * Template URL: https://bootstrapmade.com/bocor-bootstrap-template-nice-animation/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @include('layouts.frontend.navbar')

  @yield('content')

  @include('layouts.frontend.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 
    @include('layouts.frontend.scripts')
</body>

</html>