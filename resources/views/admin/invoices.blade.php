@extends('layouts.backend.app')

@section('title', 'Faktur')
@section('content-header')
    <h1>Faktur</h1>
    <a href="{{ route('admin.invoices.client') }}" class="btn btn-sm btn-success mt-3"><i class="bi bi-plus-circle-fill"></i> Buat Faktur Baru</a>
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
                            <th>Client</th>
                            <th>Total</th>
                            <th>Total Pajak</th>
                            <th>Paket Berlangganan</th>
                            <th>Tanggal</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $item)   
                        <tr>
                            <td><a href="#" data-toggle="modal" data-target="#invModal{{ $item->number }}">{{ $item->client->fullname }}</a></td>

                                <!-- Modal -->
                                <div class="modal fade" id="invModal{{ $item->number }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Invoice # {{ $item->number }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            {{-- fa fa-trash --}}
                                            <form action="{{ route('invoices.delete', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip" data-placement="bottom" title="Hapus Faktur" onclick="return confirm('Anda yakin menghapus faktur ini?')"><i class="fas fa-trash text-danger"></i></button>
                                            </form>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="{{ route('invoices.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="number">Nomor Faktur</label>
                                                <input type="text" name="number" id="number" class="form-control" value="{{ $item->number }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="klien">Klien</label>
                                                <input type="text" name="klien" id="klien" class="form-control" value="{{ $item->client->fullname }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="total">Total</label>
                                                <input type="text" name="total" id="total" class="form-control" value="{{ $item->total }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="total_tax">Total Pajak</label>
                                                <input type="text" name="total_tax" id="total_tax" class="form-control" value="{{ $item->total_tax }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="due_date">Jatuh Tempo</label>
                                                <input type="text" name="due_date" id="due_date" class="form-control" value="{{ $item->due_date }}" readonly>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Anda yakin mengubah status faktur ini? ')">Tandai telah Lunas</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            <td>{{ $item->total }}</td>
                            <td>{{ $item->total_tax }}</td>
                            <td>{{ $item->client->produk->nama_produk }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->date))}}</td>
                            <td>{{ date('d/m/Y', strtotime($item->due_date))}}</td>
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