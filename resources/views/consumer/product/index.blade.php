@extends('backend.default')

@section('content')
     <!-- tabel -->
     
   <div class="box-body">
         <table class="table table-bordered table-hover" 
         id="dataTable">
              <thead>
                  <tr>
                      <th>Kode Barang</th>
                      <th>Nama Suplier</th>
                      <th>Nama Barang</th>
                      <th>Kategori Barang</th>
                      <th>Harga Per-Unit</th>
                      <th>Jumlah Barang</th>
                      <th>Tanggal Barang Masuk</th>
                      <th>Tindakan</th>
              </thead>
          </table>
        </div>
   </div>
   
   <div class="container cetak">
        <a href="{{ route('consumer.generatePdfProducts') }}" class="btn btn-outline-primary btn-cetak">
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
                ajax: "{{ route('consumer.api.product') }}",
                columns: [
                    {data: 'id'},
                    {data: 'name_supplier'},
                    {data: 'name'},
                    {data: 'category'},
                    {data: 'harga_unit'},
                    {data: 'total_persediaan'},
                    {data: 'created_at'},
                    {data: 'action'}
                ]
            });
        });
     </script>
@endpush