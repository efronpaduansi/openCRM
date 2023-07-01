@extends('layouts.backend.app')

@section('title', 'Profile')
@section('content-header')
    <h1>Profile</h1>
@endsection
@section('content')
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary">Anda login sebagai {{ Auth::user()->name }}</div>
                <div class="card-body text-center">
                   @if (Auth::user()->gambar == null)
                        <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                        @else
                        <img src="{{ asset('uploads/profile/'. Auth::user()->gambar) }}" class="img-circle elevation-2" alt="User Image" height="160" width="160">
                    @endif 
                  
                   <br>
                    <form action="{{ route('admin.profile.change-profile-photo', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="gambar" class="@error('gambar') is-invalid @enderror">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-sm btn-secondary">Upload foto profil</button>
                    </form>
                    <form action="{{ route('admin.profile.update', Auth::user()->id) }}" class="text-left" method="POST">
                        @csrf 
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->role }}" readonly>
                        </div>
                        <div class="tombol">
                            <button type="submit" class="btn btn-success mr-3">Update</button>
                            <a href="#" data-toggle="modal" data-target="#passModal{{ Auth::user()->id }}" class="text-primary"><i class="bi bi-key"></i> Ubah Password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    
    <!-- Password Modal -->
<div class="modal fade" id="passModal{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.profile.update-pass', Auth::user()->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="oldPass">Password lama</label>
                <input type="password" class="form-control @error('oldPass') is-invalid @enderror" id="oldPass" name="oldPass" placeholder="Masukan password lama" required>
                @error('oldPass')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="newPass">Password baru</label>
                <input type="password" id="newPass" name="newPass" class="form-control @error('newPass') is-invalid @enderror" placeholder="Masukan password baru" required>
                @error('newPass')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="passConf">Konfirmasi password baru</label>
                <input type="password" id="passConf" name="passConf" class="form-control @error('passConf') is-invalid @enderror" placeholder="Masukan konfirmasi password baru" required>
                @error('passConf')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection