@extends('layouts.backend.app')

@section('title', 'Invoices')
@section('content-header')
    <h1>Pembayaran Lunas</h1>
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
                            <th>Total</th>
                            <th>Total Pajak</th>
                            <th>Klien</th>
                            <th>Tanggal</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $item)   
                        <tr>
                            <td><a href="{{ route('my.invoice', $item->id) }}" data-target="_blank">{{ $item->number }}</a></td>
                            <td>{{ $item->total }}</td>
                            <td>{{ $item->total_tax }}</td>
                            <td>{{ $item->client->fullname }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->date))}}</td>
                            <td>{{ date('d/m/Y', strtotime($item->due_date))}}</td>
                            <td>
                                @if ($item->status == 'Unpaid')
                                    <small class="badge badge-danger">{{ $item->status }}</small>
                                @elseif($item->status == 'Paid')
                                    <small class="badge badge-success">{{ $item->status }}</small>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection