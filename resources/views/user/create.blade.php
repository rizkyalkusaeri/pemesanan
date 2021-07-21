@extends('layouts.master')
@section('title')
    <title>Tambah User</title>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>User</h4>
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
                            <label for="">Nama User</label>
                            <input type="text" name="name" required
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" required
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" required
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><strong>Konfirmasi Password</strong></label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role" id="role" required
                                class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}">
                                <option value="direktur">Direktur</option>
                                <option value="staff">Staff Admin</option>
                                <option value="gudang">Gudang</option>
                                <option value="ppic">PPIC</option>

                            </select>
                            <p class="text-danger">{{ $errors->first('role') }}</p>
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
