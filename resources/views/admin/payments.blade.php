@extends('layouts.backend.app')

@section('title', 'Payments')
@section('content-header')
    <h1>Pembayaran</h1>
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
                            <th>Invoice ID</th>
                            <th>Tanggal</th>
                            <th>Metode Pembayaran</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $item)   
                        <tr>
                            <td>{{ $item->number }}</td>
                            <td>{{ $item->invoice_number }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->date))}}</td>
                            <td>{{ $item->method }}</td>
                            <td>{{ $item->total }}</td>
                            <td>
                                @if ($item->status == 'Unpaid')
                                    <small class="badge badge-danger">{{ $item->status }}</small>
                                @elseif($item->status == 'Paid')
                                    <small class="badge badge-success">{{ $item->status }}</small>
                                @elseif($item->status == 'Overdue')
                                    <small class="badge badge-warning">{{ $item->status }}</small>
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