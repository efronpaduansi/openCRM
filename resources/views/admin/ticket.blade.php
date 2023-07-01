@extends('layouts.backend.app')

@section('title', 'Ticket')
@section('content-header')
    <h1>Daftar Ticket</h1>
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
                            <th>No</th>
                            <th>User</th>
                            <th>Topik</th>
                            <th>Tgl Buat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($tickets as $ticket)   
                      <tr>
                        <td>{{ $ticket->id }}</td>
                        <td> <a href="{{ route('pengaduan.show', $ticket->no) }}">{{ $ticket->no }}</a></td>
                        <td>{{ $ticket->users->name }}</td>
                        <td>{{ $ticket->topik }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>{{ $ticket->status }}</td>
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