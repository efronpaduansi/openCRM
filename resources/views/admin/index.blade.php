@extends('layouts.backend.app')

@section('title', 'Dashboard')

@section('content-header')
    <h1>Welcome, {{ Auth::user()->name }}</h1>
@endsection
@section('content')
    <!-- Main content -->

        <div class="row">
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-info">
        <div class="inner">
        <h3>{{ $clientTotal }}</h3>
        <p>Clients</p>
        </div>
        <div class="icon">
        <i class="ion ion-bag"></i>
        </div>
        </div>
        </div>
        
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-warning">
        <div class="inner">
        <h3>{{  $prospekTotal }}</h3>
        <p>Prospek</p>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars"></i>
        </div>
        </div>
        </div>
        
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-success">
        <div class="inner">
        <h3>{{ $paymentPaid }}</h3>
        <p>Pembayaran Lunas</p>
        </div>
        <div class="icon">
        <i class="ion ion-person-add"></i>
        </div>
        </div>
        </div>
        
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-danger">
        <div class="inner">
        <h3>{{ $paymentUnpaid }}</h3>
        <p>Pembayaran Belum Lunas</p>
        </div>
        <div class="icon">
        <i class="ion ion-pie-graph"></i>
        </div>
        </div>
        </div>
        </div>
@endsection