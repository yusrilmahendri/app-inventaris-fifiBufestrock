@extends('backend.default')

@section('content')
     <!-- tabel -->
   <div class="box-body">
         <table class="table table-bordered table-hover" 
         id="dataTable">
              <thead>
                  <tr>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Pesan tentang barang anda, peringatan</th>

              </thead>
          </table>
        </div>
   </div>
@endsection()

@push('scripts')
<script src="{{ asset('backend/assets/js/notify.js') }}"></script>
<script src="{{ asset('backend/assets/js/notify.min.js') }}"></script>
@include('backend.partials.alerts')
 <script>
        $(function(){
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('consumer.api.bufferStock') }}",
                columns: [
                    {data: 'product_id'},
                    {data: 'name_product'},
                    {data: 'reason'},
                ]
            });
        });
     </script>
@endpush