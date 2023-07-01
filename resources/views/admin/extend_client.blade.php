@extends('layouts.backend.app')

@section('title', 'Perpanjangan')
@section('content-header')
    <h1>Perpanjangan Langganan</h1>
@endsection
@section('content')
    <div class="row">
       <div class="col-12">
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
            <div class="card p-4">
                @if (Auth::user()->role == 'admin')
                    <form action="{{ route('extend.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="client_id">Pilih Klien</label>
                            <select name="client_id" id="client_id" class="form-control">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Kirimkan</button>
                        </div>
                    </form>
                @elseif(Auth::user()->role == 'client')
                   {{-- jika $extend is not empty() --}}
                    @if (!empty($extend))
                        <p>{{ $extend->message }}</p>
                        <div class="tombol d-flex">
                            <form action="{{ route('extend.reject') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="extend_id" value="{{ $extend->id }}">
                                <button type="submit" class="btn btn-danger mr-3" onclick="return confirm('Anda mengkonfirmasi berhenti berlangganan?')">Tidak lanjut</button>
                            </form>
                            <form action="{{ route('extend.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="extend_id" value="{{ $extend->id }}">
                                <button type="submit" class="btn btn-success" onclick="return confirm('Anda yakin?')">Ya, lanjut</button>
                            </form>
                        </div>
                    @else
                        <p>Belum ada pesan yang diterima!</p>
                    @endif 
                   
                @endif
            </div>
       </div>
    </div>
@endsection