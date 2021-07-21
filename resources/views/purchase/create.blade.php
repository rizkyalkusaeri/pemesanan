@extends('layouts.master')
@section('title')
    <title>Job Order</title>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('purchase.store', [$order->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4>Upload Job Order</h4>
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
                            <label>File Purchasing</label>
                            <input type="file" class="form-control" value="{{ old('purchase') }}" name="purchase"
                                id="purchase">

                            @error('purchase')
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
