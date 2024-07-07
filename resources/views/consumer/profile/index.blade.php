@extends('backend.default')

@section('content')
<section class="section profile">
    <div class="row">
      <div class="col-xl-16">

            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
            </ul>

            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-overview" id="profile-overview">        
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->alamat }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->phone }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">&nbsp;:&nbsp;&nbsp;{{ $consumer->email }}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="profile/{{$consumer->id}}" method="POST">

                  {{csrf_field()}}
                  @method("PUT")

                  <div class="row mb-3  @error('name') has-error @enderror ">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="{{ old('name') ?? $consumer->name }}" required autocomplete="id" autofocus>
                    </div>
                    @error('name')
                      <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>

                  <div class="row mb-3  @error('alamat') has-error @enderror ">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="alamat" class="form-control" id="about" style="height: 100px">{{ old('alamat') ?? $consumer->alamat}}</textarea>
                    </div>

                  @error('alamat')
                    <span class="help-block"> {{ $message }}</span>
                  @enderror
                  </div>

                  <div class="row mb-3  @error('phone') has-error @enderror">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="company" value="{{ old('phone') ?? $consumer->phone }}" required autocomplete="id" autofocus>
                    </div>
                  @error('phone')
                    <span class="help-block"> {{ $message }}</span>
                  @enderror
                  </div>

                  <div class="row mb-3  @error('email') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="Job" value="{{ old('email') ?? $consumer->email }}" required autocomplete="id" autofocus>
                    </div>
                    @error('email')
                     <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>
                  
                  <div class="row mb-3  @error('password') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Pasword</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="Job" value="{{ old('password') ?? $consumer->password }}" required autocomplete="id" autofocus>
                    </div>

                    @error('password')
                      <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Informasi Saya</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>
            </div><!-- End Bordered Tabs -->
          </div>
        </div>

  </section>

@endsection
  @push('scripts')  
    <script src="{{ asset('backend/assets/js/notify.js') }}"></script>
    <script src="{{ asset('backend/assets/js/notify.min.js') }}"></script>
    @include('backend.partials.alerts')
    <!-- sweat alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @endpush