@extends('backend.default')

@section('content')

<section class="section dashboard">
      <!-- Left side columns -->
      <div class="col-lg-15">
        <div class="row">
          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total Barang Masuk</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-ladder"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $productsIn }}</h6>
                     <span class="text-muted small pt-2 ps-1">item barang Masuk</span>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total Barang Keluar</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-logout-box-line"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $productsOut }}</h6>
                     <span class="text-muted small pt-2 ps-1">item barang keluar</span>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total Daftar Barang</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-product-hunt-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6><h6>{{ $products }}</h6></h6>
                     <span class="text-muted small pt-2 ps-1">item daftar barang</span>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <div class="col-xxl-6 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Buffer Stock & Reorder Point(ROP)</h5>

                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-stock-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $bufferStock }}</h6>
                     <span class="text-muted small pt-2 ps-1">item barang Masuk</span>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <div class="col-xxl-6 col-md-6">
            
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Lead Time</h5>

                <div class="d-flex align-items-center">
                   <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-time-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $leadTime }}</h6>
                     <span class="text-muted small pt-2 ps-1">item barang keluar</span>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->
      </div>
    </div>
  </section>
</main>
@endsection