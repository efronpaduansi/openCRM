@extends('layouts.backend.app')

@section('title', 'Pendaftaran')

@section('content-header')
    <h1>Pendaftaran <span class="font-weight-bold">{{ $produk->nama_produk }}</span></h1>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Isi data diri anda dibawah ini dengan benar!</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('post')
                  <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" value="{{ old('fullname') }}" autofocus>
                          @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">Email Aktif</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                          @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="phone">Telepon</label>
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                          @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group col-md-6">
                          <label for="identity_img">Foto KTP</label>
                          <input type="file" class="form-control @error('identity_img') is-invalid @enderror" id="identity_img" name="identity_img">
                          @error('identity_img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="address">Alamat</label>
                      <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                      @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="city">Kota</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}">
                        @error('city')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group col-md-4">
                        <label for="province">Provinsi</label>
                        <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') }}">
                        @error('province')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group col-md-2">
                        <label for="zip_code">Kode Pos</label>
                        <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
                        @error('zip_code')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                          Saya menyetujui syarat dan ketentuan yang berlaku
                        </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
      // jika gridCheck di klik maka tampilkan tombol submit
      $('#gridCheck').click(function() {
        if ($(this).is(':checked')) {
          $('#submit').show();
        } else {
          $('#submit').hide();
        }
      });
      
    </script>

  {{-- tampil pesan --}}
@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    <div class="alert-body">
        <strong>{{ $message }}</strong>
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
</div> 
@elseif ($message = Session::get('error'))
<div class="alert alert-danger" role="alert">
    <div class="alert-body">
        <strong>{{ $message }}</strong>
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
</div>
@endif
@endsection