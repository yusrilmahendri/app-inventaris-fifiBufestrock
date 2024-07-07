@extends('backend.default')

@section('content')
    <h5 class="card-title">Sign-Up Product</h5>
      <!-- Vertical Form -->
      <form class="row g-3" action="{{ route('consumer.store.product') }}" method="POST">
        
        {{ csrf_field() }}

        <div class="form-group @error('id') has-error @enderror">
          <label for="inputNanme4" class="form-label">Kode Product</label>
          <input type="text" class="form-control" id="inputNanme4" name="id">

          @error('id')
            <span class="help-block">{{ $message }}</span>
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

        <div class="form-group @error('category') has-error @enderror">
            <label for="inputAddress" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="" name="category">
          
            @error('category')
              <span class="help-block">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group @error('name') has-error @enderror">
          <label for="inputAddress" class="form-label">Nama Product</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="" name="name">

          @error('name')
            <span class="help-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group @error('harga_unit') has-error @enderror">
            <label for="inputAddress" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga_unit" id="price" min="0.01" step="0.01" placeholder="0.00" required>

          @error('harga_unit')
            <span class="help-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group @error('konsumsi_harian') has-error @enderror">
            <label for="konsumsi_harian" class="form-label">Konsumsi Harian</label>
            <input type="number" class="form-control" id="konsumsi_harian" placeholder="" name="konsumsi_harian" oninput="calculateROP()">
          
          @error('konsumsi_harian')
            <span class="help-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-md-6 col-sm-6">
          <div class="col-auto">
            <label for="lead_time" class="col-form-label">Waktu Tunggu</label>
          </div>
          
          <div class="col-auto @error('lead_time') has-error @enderror">
            <div class="input-group">
              <input type="number" id="lead_time" name="lead_time" class="form-control" aria-labelledby="passwordHelpInline" oninput="calculateROP()">
              <div class="input-group-append">
                <span id="passwordHelpInline" class="input-group-text">/ HARI</span>
              </div>
            </div>
          </div>
          
          @error('lead_time')
            <span class="help-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group col-md-6 col-sm-6">
          <div class="col-auto">
            <label for="rop" class="col-form-label">Reorder Point (ROP)</label>
          </div>

          <div class="col-auto">
            <input type="number" id="rop" name="rop" class="form-control" aria-labelledby="passwordHelpInline" readOnly>
          </div>
        </div>

        <div class="form-group @error('safety_stock') has-error @enderror">
            <label for="safety_stock" class="form-label">Safety Stock</label>
            <input type="number" class="form-control" id="safety_stock" placeholder="" name="safety_stock" oninput="calculateROP()">
          
          @error('safety_stock')
            <span class="help-block">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group @error('total_persediaan') has-error @enderror">
            <label for="total_persediaan" class="form-label">Total Persediaan</label>
            <input type="number" class="form-control" id="total_persediaan" placeholder="" name="total_persediaan">
          
          @error('total_persediaan')
            <span class="help-block">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="text-center" style="margin-top: 50px;">
          <button type="submit" class="btn btn-primary" style="margin-right: 25px;">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form>
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

     function calculateROP() {
        const konsumsiHarian = parseFloat(document.getElementById('konsumsi_harian').value) || 0;
        const leadTime = parseFloat(document.getElementById('lead_time').value) || 0;
        const safetyStock = parseFloat(document.getElementById('safety_stock').value) || 0;

        const rop = (konsumsiHarian * leadTime) + safetyStock;
        document.getElementById('rop').value = rop;
     }
  </script>
@endpush
