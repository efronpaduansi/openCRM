@extends('layouts.backend.app')

@section('title', 'Pengaduan')
@section('content-header')
    <h1>Pengaduan</h1> <br>
    <a href="{{ route('pengaduan.create') }}" class="btn btn-sm btn-primary">Buat Tiket Baru</a>
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
                            <th>No</th>
                            <th>User</th>
                            <th>Topik</th>
                            <th>Tgl Dibuat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduan as $item)
                       <tr>
                            <td>{{ $item->id }}</td>
                            <td> <a href="{{ route('pengaduan.show', $item->no) }}">{{ $item->no }}</a></td>
                            <td>{{ $item->users->name }}</td>
                            <td>{{ $item->topik }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->status }}</td>
                       </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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