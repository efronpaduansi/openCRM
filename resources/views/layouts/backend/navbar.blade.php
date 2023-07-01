<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-danger navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </ul>

    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu only for Client -->
      @if (Auth::user()->role == 'client')
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i> <span class="badge badge-light">{{ count($notifications) }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Anda memiliki {{ count($notifications) }} pemberitahuan baru</span> 
          <div class="dropdown-divider"></div>
          @foreach ($notifications as $notification)
          <a href="{{ route('client.notification.show', $notification->id) }}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{ $notification->title }}
            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
          </a>
          @endforeach
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

       <!-- Notifications Dropdown Menu -->
       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">You're logged as {{ Auth::user()->name }}</span>
          <div class="dropdown-divider"></div>
              <a href="{{ route('auth.logout') }}" class="dropdown-item dropdown-footer bg-danger">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->