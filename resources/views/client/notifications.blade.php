@extends('layouts.backend.app')

@section('title', 'Notifications')

@section('content-header')
    <h1>Notifications</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @foreach ($allNotif as $notif)
                <div class="card">
                    <div class="card-header">{{ $notif->title }}</div>
                    <div class="card-body">{{ $notif->message }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection