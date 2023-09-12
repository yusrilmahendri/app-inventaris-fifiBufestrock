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
                      <th>Jumlah Barang Keluar</th>
                      <th>Tanggal Barang Keluar</th>
                      <th>Tindakan</th>
              </thead>
          </table>
        </div>
   </div>

   <div class="container cetak">
        <a href="{{ route('consumer.generatePdfProductsOut') }}" class="btn btn-outline-primary btn-cetak">
            CETAK
        </a>
    </div>

    <!-- trigger pada menghapus data -->
        <form action="" method="post" id="deleteForm">
            @csrf
            @method("DELETE")
            <input type="submit" value="Hapus"
            style="display: none ">
        </form>
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
                ajax: "{{ route('consumer.api.productOut') }}",
                columns: [
                    {data: 'product_id'},
                    {data: 'name_product'},
                    {data: 'quantity'},
                    {data: 'created_at'},
                    {data: 'action'}
                ]
            });
        });
     </script>
@endpush