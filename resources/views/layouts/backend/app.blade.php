<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    @yield('title')
  </title>

  @include('layouts.backend.styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('layouts.backend.navbar')

  <!-- Main Sidebar Container -->
  @include('layouts.backend.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h1>Welcome, Efron</h1> --}}
            @yield('content-header')
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.backend.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('layouts.backend.scripts')
</body>
</html>
