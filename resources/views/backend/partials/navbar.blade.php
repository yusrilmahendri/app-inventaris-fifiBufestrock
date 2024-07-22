<div class="d-flex align-items-center justify-content-between">
  <a href="" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">INVENTARIS</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

  @if(auth()->user()->role == 'consumer')
    <li class="nav-item dropdown" >
      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number">{{ $bufferStock }}</span>
      </a><!-- End Notification Icon -->
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          Kamu memiliki {{ $bufferStock }} pesan baru
          <a href="{{ route('consumer.bufferStock') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">Lihat semua pesan</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        @foreach ($notifications as $notification)
        <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
                <h4>Buffer Stock / ROP </h4>
                <p>{{ $notification->reason }}</p>
                <p>{{ $notification->created_at->diffForHumans() }}</p>
            </div>
        </li>
        @endforeach

        @if($leadTime)
          @foreach ($leadTimes as $leadTimes)
          <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                  <h4>Lead Time </h4>
                  <p>{{ $leadTimes->notification }}</p>
                  <p>{{ $notification->created_at->diffForHumans() }}</p>
              </div>
          </li>
          @endforeach
        @endif
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
          <a href="{{ route('consumer.bufferStock') }}">Tampilkan semua pesan</a>
        </li>
      </ul><!-- End Notification Dropdown Items -->
    </li><!-- End Notification Nav -->
  @endif

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