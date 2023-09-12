@extends('backend.default')

@section('content')
<form  action="{{ route('admin.store.consumer') }}" method="POST">

  {{csrf_field()}}

    <div class="row mb-3">
        <label for="inputText" class="col-sm-2 col-form-label">Nama Konsumen</label>
        <div class="col-sm-10 @error('name') has-error @enderror">
          <input type="text" name="name" class="form-control" 
          placeholder="Masukan nama konsumen, contoh : andri cahyana">

          @error('name')
          <span class="help-block"> {{ $message }}</span>
          @enderror

        </div>
      </div>
   
    <div class="row mb-3">
      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10 @error('email') has-error @enderror">
        <input type="email" name="email" class="form-control" placeholder="andricahyana@gmail.com">

        @error('email')
          <span class="help-block"> {{ $message }}</span>
        @enderror
        
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10 @error('password') has-error @enderror">
        <input type="password" name="password" class="form-control">

        @error('password')
          <span class="help-block"> {{ $message }}</span>
       @enderror

      </div>
    </div>

    <div class="row mb-3">
      <label for="inputNumber" class="col-sm-2 col-form-label">Phone</label>
      <div class="col-sm-10 @error('phone') has-error @enderror">
        <input type="text" name="phone" class="form-control">

        @error('phone')
          <span class="help-block"> {{ $message }}</span>
        @enderror

      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
      <div class="col-sm-10">
        <select class="form-select" name="gender" aria-label="Default select example">
          <option value="pria" selected>Pria</option>
          <option value="perempuan">Perempuan</option>
        </select>
      </div>
    </div>
    
    <div class="row mb-3">
      <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
      <div class="col-sm-10 @error('alamat') has-error @enderror">
        <textarea class="form-control" name="alamat" style="height: 100px"></textarea>

        @error('alamat')
          <span class="help-block"> {{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Simpan Data Konsumen</button>
      </div>
    </div>

  </form><!-- End General Form Elements -->
@endsection
