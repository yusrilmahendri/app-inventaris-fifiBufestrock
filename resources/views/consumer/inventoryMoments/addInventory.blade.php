@extends('backend.default')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Inputan Barang Masuk</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="{{ route('consumer.addInventory.store')}}" method="POST">
       
        {{csrf_field()}}
     
        <div class="col-12">
            <label for="inputAddress" class="form-label">Kode & Nama Barang</label>
            <select name="product_id" id="" class="form-control select2">
              @foreach ($products as $product)
                  <option value="{{ $product->id }}">
                     {{ $product->id }} - {{ $product->name }}
                 </option> 
              @endforeach             
            </select>
        </div>
     
        <div class="col-12 @error('quantity') has-error @enderror">
          <label for="inputAddress" class="form-label">Jumlah Barang</label>
          <input type="text" class="form-control" id="inputAddress" name="quantity" placeholder="Masukan jumlah barang yang ingin dikeluarkan">
         
          @error('quantity')
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

@push('select2css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/select2.min.css') }}">
@endpush

@push('scripts')  
<script src="{{ asset('backend/assets/js/notify.js') }}"></script>
<script src="{{ asset('backend/assets/js/notify.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/select2.full.min.js') }}"></script>
@include('backend.partials.alerts')
<script>
   $('.select2').select2();
</script>
  <!-- sweat alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush


