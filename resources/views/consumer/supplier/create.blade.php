@extends('backend.default')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Daftarkan Supplier</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="{{ route('consumer.supplier.store') }}" method="POST">
       
       @csrf

        <div class="col-12 @error('name') has-error @enderror">
          <label for="inputNanme4" class="form-label">Name</label>
          <input type="text"  name="name" class="form-control" id="inputNanme4">
        
          @error('name')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="col-12 @error('email') has-error @enderror">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email"name="email" class="form-control" id="inputEmail4">
          @error('email')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="col-12 @error('phone') has-error @enderror">
          <label for="inputAddress" class="form-label">Phone</label>
          <input type="tel" name="phone" class="form-control" id="phone"  placeholder="Enter your phone number" required>

          @error('phone')
           <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="col-12">
          <label for="yourEmail" class="form-label">Gender</label>
          <select class="form-select" name="gender" aria-label="Default select example">
            <option selected value="pria">Pria</option>
            <option value="perempuan">Wanita</option>
          </select>
        </div>

        <div class="col-12 @error('alamat') has-error @enderror">
          <label for="inputAddress" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="inputAddress" name="alamat">
          @error('alamat')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>

      </form><!-- Vertical Form -->

    </div>
  </div>
@endsection
@push('scripts')  
  <script src="{{ asset('backend/assets/js/notify.js') }}"></script>
  <script src="{{ asset('backend/assets/js/notify.min.js') }}"></script>
  @include('backend.partials.alerts')
  <!-- sweat alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush