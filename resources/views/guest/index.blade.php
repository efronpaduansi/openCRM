@extends('layouts.backend.app')

@section('title', 'Dashboard')

@section('content-header')
    <h1>Welcome, {{ Auth::user()->name }}</h1>
@endsection
@section('content')
    <!-- Main content -->

        <div class="row">
        <div class="col-lg-12 col-12">
        
            <div class="small-box bg-info">
            <div class="inner">
            <h3>Selamat datang</h3>
            {{-- <p>Clients</p> --}}
        </div>
        </div>
        </div>
@endsection