@extends('backend.default')

@section('content')
<section class="section profile">
    <div class="row">
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body pt-3">

            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Data Barang</button>
              </li>
            </ul>

            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-overview" id="profile-overview">        
                <h5 class="card-title">Details Data Supplier</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nama Supplier</div>
                  <div class="col-lg-9 col-md-8">{{ $supplier->name }}</div>
                </div>

                @if(isset($supplier->email) && !empty($supplier->email))
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ $supplier->email }}</div>
                </div>
                @endif
            
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{ $supplier->phone }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">gender</div>
                    <div class="col-lg-9 col-md-8">{{$supplier->gender }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8">{{ $supplier->alamat }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Tanggal Daftar</div>
                  <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($supplier->created_at)->format('d-m-Y') }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Kategori Barang Yang di suplaykan</div>
                    <div class="col-4">
                      <ul class="list">
                    @if(count($uniqueCategories) > 0)
                        @foreach($uniqueCategories as $category)
                            <li class="list-item">
                                <a href="{{ route('consumer.category', ['id' => $id, 'category' => urlencode($category)]) }}" style="text-decoration: none;">
                                    {{ $category }}
                                </a>
                            </li>
                        @endforeach
                    @else 
                        <div class="col-lg-9 col-md-8">Tidak ada kategori barang yang di suplaykan.</div>
                    @endif
                    </ul>
                  </div>
                </div>
              </div>

              

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{ route('consumer.supplier.update', $supplier) }}" method="POST">

                  {{csrf_field()}}
                  @method("PUT")
                  
                  <div class="row mb-3 @error('name') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Name Supplier</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="Job" value="{{ old('name') ?? $supplier->name }}" required autocomplete="id" autofocus>
                    </div>

                    @error('name')
                     <span class="help-block"> {{ $message }}</span>
                   @enderror
                  </div>

                  <div class="row mb-3 @error('phone') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Job" value="{{ old('phone') ?? $supplier->phone }}" required autocomplete="id" autofocus>
                    </div>

                    @error('phone')
                       <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>

                  <div class="row mb-3 @error('alamat') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="alamat" type="text" class="form-control" id="Job" value="{{ old('alamat') ?? $supplier->alamat }}" required autocomplete="id" autofocus>
                    </div>

                    @error('alamat')
                       <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ubah Data Supplier</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>
            </div><!-- End Bordered Tabs -->
          </div>
        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
          $('.list-item').click(function() {
          $('.list-item').removeClass('active');
          $(this).addClass('active');
        });
      });
</script>
@endpush

  