@extends('layouts.backend.app')

@section('title', 'Faktur')
@section('content-header')
    <h1>Pilih Client</h1>
@endsection
@section('content')
    <div class="row">
       <div class="col-12">
            <div class="card p-4">
                <form action="{{ route('admin.invoices.get_by_client') }}" method="POST">
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
                        <button type="submit" class="btn btn-primary">Lanjutkan</button>
                    </div>
                </form>
            </div>
       </div>
    </div>
@endsection