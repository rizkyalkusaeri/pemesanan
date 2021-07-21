@extends('layouts.master')
@section('title')
    <title>Order</title>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Order</h4>
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Deskripsi Barang Yang Dipesan</label>
                            <textarea cols="30" rows="10" id="description" class="form-control"
                                name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" value="{{ old('qty') }}" name="qty">
                            @error('qty')
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
@push('page-scripts')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

@endpush

@push('after-scripts')
    <script>
        CKEDITOR.replace('description');

    </script>
@endpush
