@extends('layouts.backend.app')

@section('title', 'Dashboard')

@section('content-header')
    <h1>Welcome, {{ Auth::user()->name }}</h1>
@endsection
@section('content')
    <!-- Main content -->

        <div class="row">
        
            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{  count($notifications) }}</h3>
                        <p><a href="{{ route('client.notifications.all') }}" class="text-white">Notifikasi Baru</a></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $paymentPaid }}</h3>
                        <p><a href="{{ route('my.invoice.paid') }}" class="text-white">Pembayaran Lunas</a></p>
                    </div>
                    <div class="icon">  
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $paymentUnpaid }}</h3>
                        <p><a href="{{ route('my.invoice.unpaid') }}" class="text-white">Pembayaran Belum Lunas</a></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
        </div>
@endsection