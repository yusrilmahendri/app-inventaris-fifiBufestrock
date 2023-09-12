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
                <h5 class="card-title">Details Data Barang</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Kode Barang</div>
                  <div class="col-lg-9 col-md-8">{{ $product->id }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nama Supplier</div>
                  <div class="col-lg-9 col-md-8">{{ $product->supplier->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nama Barang</div>
                  <div class="col-lg-9 col-md-8">{{ $product->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Kategori Barang</div>
                  <div class="col-lg-9 col-md-8">{{ $product->category }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Harga Per-Unit</div>
                    <div class="col-lg-9 col-md-8">Rp. {{ number_format($product->harga_unit) }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jumlah Barang</div>
                    <div class="col-lg-9 col-md-8">{{ $product->total_persediaan }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Safety Stock</div>
                  <div class="col-lg-9 col-md-8">{{ $product->safety_stock }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Lead Time</div>
                <div class="col-lg-9 col-md-8">{{ $product->lead_time }}  Hari</div>
              </div>

              <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tanggal Barang Masuk</div>
                    <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</div>
              </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tanggal Update data Barang</div>
                    <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($product->updated_at)->format('d-m-Y') }}</div>
                </div>
              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="/consumer/product/{{$product->id}}/update" method="POST">

                  {{csrf_field()}}
                  @method("PUT")
                  
                  <div class="row mb-3 @error('harga_unit') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Harga Per-Unit Barang</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="harga_unit" type="text" class="form-control" id="Job" value="{{ old('harga_unit') ?? $product->harga_unit }}" required autocomplete="id" autofocus>
                    </div>

                    @error('harga_unit')
                     <span class="help-block"> {{ $message }}</span>
                   @enderror
                  </div>

                  <div class="row mb-3 @error('lead_time') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Lead Time Barang</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="lead_time" type="text" class="form-control" id="Job" value="{{ old('lead_time') ?? $product->lead_time }}" required autocomplete="id" autofocus>
                    </div>

                    @error('lead_time')
                       <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>

                  <div class="row mb-3 @error('safety_stock') has-error @enderror">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Safety Stock</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="safety_stock" type="text" class="form-control" id="Job" value="{{ old('safety_stock') ?? $product->safety_stock }}" required autocomplete="id" autofocus>
                    </div>

                    @error('safety_stock')
                       <span class="help-block"> {{ $message }}</span>
                    @enderror
                  </div>


                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ubah Data Barang</button>
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
  @endpush