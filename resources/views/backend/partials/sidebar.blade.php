<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @if(Auth::user()->role == 'admin')
      <li class="nav-item">
        <a class="nav-link " href="{{ url('admin/dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>Data Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.consumers') }}">
              <i class="bi bi-circle"></i><span>About Konsumen</span>
            </a>
          </li>
        </ul>
      </li>
    @endif

    @if(Auth::user()->role == 'consumer')

     <li class="nav-item">
      <a class="nav-link " href="{{ route('consumer.dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="">
        <i class="ri-product-hunt-line"></i><span>Barang</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('consumer.create.product') }}">
            <i class="bi bi-circle"></i><span>Input Barang</span>
          </a>
        </li>
      </ul>

      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('consumer.products') }}">
            <i class="bi bi-circle"></i><span>Data Barang</span>
          </a>
        </li>
      </ul>
    </li>

    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Kelola Barang</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('consumer.add.inventory') }}">
            <i class="bi bi-circle"></i><span>Edit Barang Masuk</span>
          </a>
        </li>
        <li>
          <a href="{{ route('consumer.riwayatBarangMasuk') }}">
            <i class="bi bi-circle"></i><span>Riwayat Barang Masuk</span>
          </a>
        </li>

        <li>
          <a href="{{ route('consumer.inventoryOut') }}">
            <i class="bi bi-circle"></i><span>Edit Barang Keluar</span>
          </a>
        </li>
        <li>
          <a href="{{ route('consumer.riwayatInventoryOut') }}">
            <i class="bi bi-circle"></i><span>Riwayat Barang Keluar</span>
          </a>
        </li>
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Buffer Stock</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>

      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('consumer.bufferStock') }}">
            <i class="ri-alarm-warning-line"></i>
            <span>Pesan Tentang Stock</span>
          </a>
        </li>
      </ul>
    </li> 

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="bx bxs-notification"></i><span>Lead Time</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('consumer.leadTime') }}">
            <i class="bi bi-circle"></i>
            <span>Pesan tentang barang saya</span>
          </a>
        </li>
      </ul>
    </li><!-- End Charts Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('consumer.supplier.index') }}">
        <i class="bx bxs-user"></i><span>Informasi Supplier</span>
      </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('consumer.profile') }}">
        <i class="bx bxs-user"></i><span>Profile Saya</span>
      </a>
    </li><!-- End Contact Page Nav -->

    @endif

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/logout') }}">
        <i class="ri-logout-circle-line"></i>
        <span>Logout</span>
      </a>
    </li><!-- End Contact Page Nav -->

    </ul>
  </aside><!-- End Sidebar-->