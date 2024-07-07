@extends('backend.default')

@section('content')
    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

      <img src="{{ asset('backend/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
      <h2>{{ $consumer->name }}</h2>
      <h3>Consumer</h3>
    </div>
  </div>

</div>

<div class="col-xl-16">

  <div class="card">
    <div class="card-body pt-3">
      <!-- Bordered Tabs -->
      <ul class="nav nav-tabs nav-tabs-bordered">

        <li class="nav-item">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
            Information profile Consumers
          </button>
        </li>
      </ul>
      <div class="tab-content pt-2">

        <div class="tab-pane fade show active profile-overview" id="profile-overview">
          <h5 class="card-title">Profile Details</h5>

          
          <div class="row">
            <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
            <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->name }}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Email</div>
            <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->email }}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Status</div>
            <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;Konsumen</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Gender</div>
            <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->gender }}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Phone</div>
            <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->phone }}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Alamat</div>
            <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->alamat }}</div>
          </div>

        </div>
      </div><!-- End Bordered Tabs -->
  </div>
@endsection