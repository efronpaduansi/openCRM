@extends('layouts.backend.app')

@section('title', 'Produk')
@section('content-header')
    <h1>Daftar Produk</h1>
    <button class="btn btn-success my-3" data-toggle="modal" data-target="#newProduk"><i class="bi bi-plus-circle-fill"></i> Tambah Produk</button>
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
                            <th>Nama Produk</th>
                            <th>Harga (Rp.)</th>
                            <th>Total Pajak (Rp.)</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($produk as $item)   
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->total_pajak }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#editProduk{{ $item->id }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                          {{-- Edit modal --}}
                            <div class="modal fade" id="editProduk{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Produk # {{ $item->id }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('admin.produk.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="needs-validate" novalidate>
                                      @csrf
                                      @method('put')
                                      <div class="form-group">
                                        <label for="nama_produk">Nama Produk <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" value="{{ $item->nama_produk }}" required>
                                        @error('nama_produk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                      </div>
                                      <div class="form-group">
                                        <label for="harga">Harga (Rp.) <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $item->harga }}">
                                        <small>Pajak akan dihitung 10% dari total harga.</small>
                                        @error('harga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                      </div>
                                      <div class="form-group">
                                        <label for="gambar">Gambar <small class="text-danger">*</small></label>
                                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                                        @error('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                      </div>
                                      <div class="form-group">
                                        <label for="deskripsi">Deskripsi Produk <small class="text-danger">*</small></label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="30" rows="4">{{ $item->deskripsi }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          {{-- End edit modal --}}

                          <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin menghapus data ini?')"><i class="bi bi-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="newProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Produk Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label for="nama_produk">Nama Produk <small class="text-danger">*</small></label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk">
              </div>
              <div class="form-group">
                <label for="harga">Harga (Rp.) <small class="text-danger">*</small></label>
                <input type="number" class="form-control" id="harga" name="harga">
                <small>Pajak akan dihitung 10% dari total harga.</small>
              </div>
              <div class="form-group">
                <label for="gambar">Gambar <small class="text-danger">*</small></label>
                <input type="file" class="form-control" id="gambar" name="gambar">
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi Produk <small class="text-danger">*</small></label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="4"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection