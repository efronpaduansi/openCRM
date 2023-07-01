@extends('layouts.backend.app')

@section('title', 'Pembayaran')
@section('content-header')
    <h1>Pembayaran</h1>
@endsection
@section('content')
   <div class="row">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
               <span class="font-weight-bold">Hati-hati Penipuan!</span> Lakukan Pembayaran hanya ke salah satu rekening dibawah ini.
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('backend/dist/bank/bca.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <h5 class="text-center">BANK BCA</h5>
                  <p class="card-text">No. Rekening : 021232</p>
                  <p>Atas Nama : CV. HH Net</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 20rem;">
                <img src="{{ asset('backend/dist/bank/mandiri1.png') }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <h5 class="text-center">BANK MANDIRI</h5>
                  <p class="card-text">No. Rekening : 2121222</p>
                  <p>Atas Nama : CV. HH Net</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('backend/dist/bank/bni.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <h5 class="text-center">BANK BNI</h5>
                  <p class="card-text">No. Rekening : 82883767</p>
                  <p>Atas Nama : CV. HH Net</p>
                </div>
            </div>
        </div>
    </div>
    <div class="tombol d-flex justify-content-center">
        <a href="https://api.whatsapp.com/send?phone=+62%20822-9467-0550&text=Salam%20Admin%20HHNet.%20Saya%20atas%20nama%20{{ Auth::user()->name }}%20telah%20melakukan%20pembayaran.%20mohon%20untuk%20dikonfirmasi." class="btn btn-success" target="_blank"><i class="bi bi-whatsapp"></i> Konfirmasi Pembayaran via WhatsApp</a>
    </div> 
@endsection