<button href="{{ route('consumer.destroyProductIn', $model) }}" class="btn btn-danger" 
  id="delete" style="margin-top:15px;">
  <i class="ri-delete-bin-5-fill"></i>
</button>

<!-- sweat alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('button#delete').on('click', function(e){
         e.preventDefault();
         var href = $(this).attr('href');
         //sweat alert
         Swal.fire({
            title: 'Apakah yakin dihapus data ini?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapuskan saja datanya'
          }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById('deleteForm').action = href;
              document.getElementById('deleteForm').submit();
              Swal.fire(
                'Terhapus',
                'Data Berhasil dihapus',
                'success'
              )
            }
          });
   });
</script>