@extends('layouts.backend.app')

@section('title', 'Upgrade')
@section('content-header')
    <h1>Daftar Upgrade Request</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($prospeks as $prospek)   
                      <tr>
                        <td>{{ $prospek->id }}</td>
                        <td>{{ $prospek->fullname }}</td>
                        <td>{{ $prospek->email }}</td>
                        <td>{{ $prospek->phone }}</td>
                        <td>{{ $prospek->address }}</td>
                        <td>{{ $prospek->city }}</td>
                        <td>{{ $prospek->province }}</td>
                        <td class="text-danger">{{ $prospek->status->status }}</td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#showModal{{ $prospek->id }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                          {{-- Edit modal --}}
                            <div class="modal fade" id="showModal{{ $prospek->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Prospek # {{ $prospek->id }} <small class="badge badge-success rounded-pill">Calon Pelanggan Baru</small></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('admin.prospek.convert_to_client', $prospek->id) }}" method="POST">
                                      @csrf
                                      @method('post')
                                      <div class="form-group">
                                        <label for="produk_id">Paket</label>
                                        <input type="hidden" name="prod_id" value="{{ $prospek->produk->id }}">
                                        <input type="text" class="form-control" id="produk_id" name="produk_id" value="{{ $prospek->produk->nama_produk }}" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label for="fullname">Nama Lengkap<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $prospek->fullname }}">
                                      </div>
                                      <div class="form-group">
                                        <label for="email">Email Address<small class="text-danger">*</small></label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $prospek->email }}">
                                      </div>
                                      <div class="form-group">
                                        <label for="phone">Telepon <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" id="phone" name="phone" value="{{ $prospek->phone }}">
                                      </div>
                                      <div class="form-group">
                                        <label for="address">Alamat<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $prospek->address }}">
                                      </div>
                                      <div class="form-group">
                                        <label for="city">Kota <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ $prospek->city }}">
                                      </div>
                                      <div class="form-group">
                                        <label for="province">Provinsi <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="province" name="province" value="{{ $prospek->province }}">
                                      </div>
                                      <div class="form-group">
                                        <label for="zip_code">Kode Pos <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $prospek->zip_code }}">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Anda yakin mengkonversi prospek ini? klik BATAL jika anda tidak yakin!')">Setujui</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          {{-- End edit modal --}}

                          {{-- <form action="{{ route('admin.produk.destroy', $prospek->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin menghapus data ini?')"><i class="bi bi-trash"></i></button>
                          </form> --}}
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Tampilkan pesan --}}
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
        </div>
    </div>
@endsection