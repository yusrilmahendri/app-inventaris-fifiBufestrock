<div class="d-flex align-items-center justify-content-between">
  <a href="" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">INVENTARIS</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown">
  

    <li class="nav-item dropdown pe-3">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="{{ asset('backend/assets/img/profile-img.jpg') }}" style="margin-right:5px;" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block" style="margin-right:50px;">
          {{ Auth::user()->name }}     
        </span>
      </a>
    </li>

  </ul>
</nav>