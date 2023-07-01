@extends('layouts.backend.app')

@section('title', 'Faktur')
@section('content-header')
    <h1>Buat Faktur Untuk {{ $client->fullname }}</h1>
@endsection
@section('content')
    <div class="row">
       <div class="col-12">
            <div class="card p-4">
                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="paket">Paket Berlangganan</label>
                        <input type="text" name="paket" id="paket" value="{{ $client->produk->nama_produk }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Nama Client</label>
                        <select name="client_id" id="client_id" class="form-control">
                                <option value="{{ $client->id }}">{{ $client->fullname }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Faktur</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Tanggal Jatuh Tempo</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="number" name="total" id="total" class="form-control" value="{{ $client->produk->harga }}">
                    </div>
                    <div class="form-group">
                        <label for="total_tax">Total Pajak</label>
                        <input type="number" name="total_tax" id="total_tax" value="{{ $client->produk->total_pajak }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <textarea name="note" id="note" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('admin.invoices.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary ml-2">Kirim</button>
                    </div>
                </form>
            </div>
       </div>
    </div>
@endsection