@extends('layouts.master')
@section('title')
    <title>Upload Bukti Pembayaran</title>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('invoice.update', [$order->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4>Upload Bukti Pembayaran</h4>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Error!</h5>
                        {!! session('error') !!}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control" value="{{ $order->user->name }}" name="name" readonly>
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email Customer</label>
                            <input type="text" class="form-control" value="{{ $order->user->email }}" name="email"
                                readonly>
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea cols="30" rows="10" id="description" class="form-control" readonly
                                name="description">{{ $order->description }}</textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control" value="{{ $order->qty }}" name="qty" readonly>
                            @error('qty')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>File Invoice</label>
                            <a href="{{ asset('storage/invoices/' . $order->invoice->file) }}"> <img
                                    src="{{ asset('assets/img/pdf.png') }}" alt="order" width="20px"> Invoice.pdf</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Upload Bukti Pembayaran</label>
                            <input type="file" class="form-control" value="{{ old('bukti') }}" name="bukti" id="bukti">

                            @error('bukti')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
