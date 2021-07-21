@extends('layouts.master')
@section('title')
    <title>Edit Bahan Baku</title>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('bahan.update', [$bahan->id]) }}" method="POST">
            @csrf
            @method('put')
            <div class="card-header">
                <h4>Edit Bahan Baku</h4>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Bahan Baku</label>
                            <input type="text" name="name" required value="{{ $bahan->name }}"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Stock</label>
                            <input type="number" name="stock" required value="{{ $bahan->stock }}"
                                class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}">
                            <p class="text-danger">{{ $errors->first('stock') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Satuan</label>
                            <input type="text" name="additional" required value="{{ $bahan->additional }}"
                                class="form-control {{ $errors->has('additional') ? 'is-invalid' : '' }}">
                            <p class="text-danger">{{ $errors->first('additional') }}</p>
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
