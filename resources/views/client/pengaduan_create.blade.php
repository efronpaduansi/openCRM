@extends('layouts.backend.app')

@section('title', 'Pengaduan')
@section('content-header')
    <h1>Buat Tiket Baru</h1> <br>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <form action="{{ route('pengaduan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="topik">Topik <small class="text-danger">*</small></label>
                        <select name="topik" id="topik" class="form-control @error('topik') is-invalid @enderror">
                            <option value="">--Pilih--</option>
                            <option value="Gangguan Internet">Gangguan Internet</option>
                            <option value="Masalah Pembayaran">Masalah Pembayaran</option>
                        </select>
                        @error('topik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi <small class="text-danger">*</small></label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="4" class="form-control @error('deskripsi') is-invalid @enderror"></textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status <small class="text-danger">*</small></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="Open">Open</option>
                            <option value="Closed">Closed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection