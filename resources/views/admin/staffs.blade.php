@extends('layouts.backend.app')

@section('title', 'Staffs')
@section('content-header')
    <h1>Staffs</h1>
    <button class="btn btn-success my-3" data-toggle="modal" data-target="#newStaff"><i class="bi bi-plus-circle-fill"></i> Tambah Staff Baru</button>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
          {{-- Tampilkan pesan --}}
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
            <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Gabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $staff) 
                        <tr>
                            <td>{{ $staff->id }}</td>
                            <td><img src="{{ asset('uploads/' . $staff->gambar) }}" height="75" alt="gambar"></td>
                            <td><a href="#" data-toggle="modal" data-target="#showModal{{ $staff->id }}">{{ $staff->name }}</a></td>
                                <!-- Show Staff Modal -->
                                <div class="modal fade" id="showModal{{ $staff->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                        <h5 class="modal-title" id="exampleModalLabel">Staff # {{ $staff->id }}</h5>
                                        <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="right" title="Hapus staff ini?" onclick="return confirm('Yakin menghapus data?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        </div>
                                        <div class="modal-body">
                                         <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="gambar">Foto Profil</label>
                                                <input type="file" name="gambar" id="gambar" class="form-control">
                                                <span class="text-danger">* Kosongkan jika tidak ingin mengubah foto profil</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Nama Lengkap</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $staff->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ $staff->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select name="role" id="role" class="form-control">
                                                    <option value="Staff">Staff</option>
                                                </select>
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
                            <td>{{ $staff->email }}</td>
                            <td>{{ $staff->role }}</td>
                            <td>{{ date('d/M/Y', strtotime($staff->created_at))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="newStaff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Staff Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gambar">Foto Profil <small class="text-danger">*</small></label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
              <div class="form-group">
                <label for="name">Nama Lengkap <small class="text-danger">*</small></label>
                <input type="text" class="form-control" id="name" name="name" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="email">Email Address <small class="text-danger">*</small></label>
                <input type="email" class="form-control" id="email" name="email" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="password">Kata Sandi <small class="text-danger">*</small></label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="off">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection