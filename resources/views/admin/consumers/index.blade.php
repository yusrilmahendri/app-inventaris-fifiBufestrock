@extends('backend.default')

@section('content')
     <!-- tabel -->
   <div class="box-body">
         <table class="table table-bordered table-hover" 
         id="dataTable">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Gender</th>
                      <th>Tindakan</th>
                  </tr>
              </thead>
          </table>
        </div>
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
                ajax: "{{ route('admin.api.consumer') }}",
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'phone'},
                    {data: 'gender'},
                    {data: 'action'},
                ]
            });
        });
     </script>
@endpush