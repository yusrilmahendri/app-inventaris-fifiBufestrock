@extends('backend.default')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Sign-Up Product</h5>

      <!-- Vertical Form -->
      <form class="row g-3" action="{{ route('consumer.store.product') }}" method="POST">
        
        {{csrf_field()}}

        <div class="form-gorup @error('id') has-error @enderror" >
          <label for="inputNanme4" class="form-label">Kode Product</label>
          <input type="text" class="form-control" id="inputNanme4" name="id">

          @error('id')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="supplier_id">Supplier  
            <a href="{{ route('consumer.supplier.create') }}">
              <i class="ri-add-circle-line x-plus">Daftarkan Supplier</i>
            </a>
          </label>
          <select name="supplier_id" id="" class="form-control select2">
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">
                    {{ $supplier->name }}
               </option> 
            @endforeach             
          </select>
        </div>

          <div class="form-gorup @error('category') has-error @enderror" >
            <label for="inputAddress" class="form-label">Kategori</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="" name="category">
          
            @error('category')
              <span class="help-block"> {{ $message }}</span>
            @enderror
          </div>
        
        <div class="form-gorup @error('name') has-error @enderror" >
          <label for="inputAddress" class="form-label">Nama Product</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="" name="name">

          @error('name')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

        <div class="form-gorup @error('harga_unit') has-error @enderror" >
            <label for="inputAddress" class="form-label">Harga</label>
            <input type="number"  class="form-control" name="harga_unit" id="price" min="0.01" step="0.01" placeholder="0.00" required>

          @error('harga_unit')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>
        
        <div class="form-gorup @error('total_persediaan') has-error @enderror" >
            <label for="inputAddress" class="form-label">Total Persediaan</label>
            <input type="number" class="form-control" id="inputAddress" placeholder="" name="total_persediaan">
          
          @error('total_persediaan')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>
        
        <div class="form-gorup @error('safety_stock') has-error @enderror" >
          <label for="inputAddress" class="form-label">Safety Stock</label>
          <input type="number" class="form-control" id="inputAddress" placeholder="" name="safety_stock">
          
          @error('safety_stock')
            <span class="help-block"> {{ $message }}</span>
          @enderror
        </div>

      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="inputPassword6" class="col-form-label">Waktu Tunggu</label>
        </div>

        <div class="col-auto @error('lead_time') has-error @enderror">
          <input type="number" id="inputPassword6"  name="lead_time" class="form-control" aria-labelledby="passwordHelpInline">
        </div>
        <div class="col-auto">
          <span id="passwordHelpInline" class="form-text">
            / HARI
          </span>
        </div>
        @error('lead_time')
          <span class="help-block"> {{ $message }}</span>
        @enderror
      </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form>
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
@endpush