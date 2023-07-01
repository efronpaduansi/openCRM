<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-danger">
      <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">OpenCRM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.index') }}" class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.customers.index') }}" class="nav-link {{ (request()->is('admin/customers')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Klien
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.prospek.index') }}" class="nav-link {{ (request()->is('admin/prospek')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-clock"></i>
              <p>
                Prospek
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.prospek.upgrade') }}" class="nav-link {{ (request()->is('admin/upgrade')) ? 'active' : '' }}">
              <i class="bi bi-cloud-plus-fill"></i>
              <p>
                Upgrade
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('extend.index') }}" class="nav-link {{ (request()->is('admin/upgrade')) ? 'active' : '' }}">
              <i class="bi bi-arrow-repeat"></i>
              <p>
                Perpanjangan
              </p>
            </a>
          </li>
          <li class="nav-item {{ (request()->is('admin/invoices')) || (request()->is('admin/invoices/client')) || (request()->is('admin/invoices/create')) || (request()->is('admin/payments')) || (request()->is('admin/payments')) || (request()->is('admin/produk')) || (request()->is('admin/ticket')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>
                Penjualan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.invoices.index') }}" class="nav-link {{ (request()->is('admin/invoices')) || (request()->is('admin/invoices/create')) || (request()->is('admin/invoices/client')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Faktur</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.payments.index') }}" class="nav-link {{ (request()->is('admin/payments')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembayaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.produk.index') }}" class="nav-link {{ (request()->is('admin/produk')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produk</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ (request()->is('admin/profile')) || (request()->is('admin/staffs')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Pengaturan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.profile.index') }}" class="nav-link {{ (request()->is('admin/profile')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.staff.index') }}" class="nav-link {{ (request()->is('admin/staffs')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Staff</p>
                </a>
              </li>
            </ul>
          </li>
          @elseif (Auth::user()->role == 'client')
          <li class="nav-item">
            <a href="{{ route('client.index') }}" class="nav-link {{ (request()->is('client')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('my.invoices', Auth::user()->id) }}" class="nav-link {{ (request()->is('client/invoices/')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill-alt"></i>
              <p>Tagihan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('client.produk.mypackage') }}" class="nav-link">
              <i class="bi bi-person-lines-fill"></i>
              <p>Paket Saya</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('extend.index') }}" class="nav-link">
              <i class="bi bi-arrow-repeat"></i>
              <p>Info Perpanjangan</p>
            </a>
          </li>
          @elseif(Auth::user()->role == 'guest')
            {{-- <li class="nav-item">
              <a href="{{ route('pendaftaran.index') }}" class="nav-link {{ (request()->is('guest/pilih-produk')) ? 'active' : '' || (request()->is('guest/pendaftaran')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-clock"></i>
                <p>Pendaftaran</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{ route('produk') }}" class="nav-link {{ (request()->is('guest/produk')) ? 'active' : '' }}">
                <i class="nav-icon bi bi-box2-heart"></i>
                <p>Daftar Produk</p>
              </a>
            </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>