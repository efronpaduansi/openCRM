@extends('layouts.backend.app')

@section('title', 'Invoice')
@section('content-header')
    <h1>Invoices # {{ $invoice->number }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <h4>
            <i class="fas fa-globe"></i> HH Net
            <small class="float-right">{{ date('d/m/Y', strtotime($invoice->date)) }}</small>
            </h4>
        </div>
    </div>

    <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
            From
            <address>
            <strong>Admin, HH Net.</strong><br>
            Jl. Ampera Poncol<br>
            Tangerang Selatan, 15560<br>
            Phone: (804) 123-5432<br>
            Email: elalestarisagala12@gmail.com
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            To
            <address>
            <strong>{{ $invoice->client->fullname }}</strong><br>
            {{ $invoice->client->address }}<br>
            {{ $invoice->client->city }}<br>
            Phone: {{ $invoice->client->phone }}<br>
            Email: <a href="">{{ $invoice->client->email }}</a>
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            <b>Invoice #{{ $invoice->number }}</b><br>
            <br>
            <b>Payment Due:</b> {{ date('d/m/Y', strtotime($invoice->due_date)) }}<br>
        </div>

    </div>


    <div class="row">
    <div class="col-12 table-responsive">
    <table class="table table-striped">
    <thead>
    <tr>
        <th>Qty</th>
        <th>Product</th>
        <th>Description</th>
        <th>Subtotal</th>
    </tr>
    </thead>
        <tr>
            <td>1</td>
            <td>{{ $invoice->client->produk->nama_produk }}</td>
            <td>{{ $invoice->note }}</td>
            <td>Rp. {{$invoice->total }}</td>
        </tr>
    </table>
    </div>
    <div class="row">

        <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <img src="{{ asset('backend/dist/img/credit/visa.png') }}" alt="Visa">
        <img src="{{ asset('backend/dist/img/credit/mastercard.png') }}" alt="Mastercard">
        <img src="{{ asset('backend/dist/img/credit/american-express.png') }}" alt="American Express">
        <img src="{{ asset('backend/dist/img/credit/paypal2.png') }}" alt="Paypal">
            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            Mohon untuk melakukan pembayaran sebelum tanggal Jatuh Tempo demi kenyamanan anda dalam menggunakan layanan kami.
        </p>
        </div>
        
        <div class="col-6">
        <p class="lead">Amount Due {{ date('d/m/Y', strtotime($invoice->due_date)) }}</p>
        <div class="table-responsive">
        <table class="table">
            <tr>
                <th style="width:50%">Subtotal:</th>
                <td>Rp. {{ $invoice->total }}</td>
            </tr>
            <tr>
                <th>Tax (11%)</th>
                <td>Rp. {{ $invoice->total_tax }}</td>
            </tr>
            <tr>
                <th>Total:</th>
                <td>Rp. {{ $invoice->total + $invoice->total_tax}} </td>
            </tr>
        </table>
        </div>
        </div>
            <div class="tombol ml-auto">
                <a href="{{ route('payment.link') }}" class="btn btn-primary">Bayar</a>
            </div>
        </div>
    </div>
@endsection