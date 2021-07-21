@extends('layouts.master')
@section('title')
    <title>Upload</title>
@endsection
@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered table-md">
                <tbody>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                    <?php $no = 1; ?>
                    @forelse ($data as $row)
                        <tr>
                            <td> {{ $no++ }}</td>
                            <td>
                                {!! $row->product->name !!}
                            </td>
                            <td>
                                Rp {{ number_format($row->price) }}
                            </td>
                            <td>
                                {{ $row->qty }}
                            </td>
                            <td>
                                Rp {{ number_format($row->qty * $row->price) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada data</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            {{-- {{$data->links()}} --}}
        </div>
        <form action="{{ route('produksi.update', [$order->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Produksi</h4>
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
                            <label>Perusahaan</label>
                            <input type="text" class="form-control" value="{{ $customer->company }}" name="company"
                                readonly>
                            @error('company')
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat Pengiriman</label>
                            <input type="text" class="form-control" value="{{ $customer->address }}" name="address"
                                readonly>
                            @error('address')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" class="form-control" value="{{ $customer->phone_number }}"
                                name="phone_number" readonly>
                            @error('phone_number')
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
                            <label>Catatan</label>
                            <textarea cols="30" rows="10" id="note" class="form-control" readonly
                                name="note">{{ $order->note }}</textarea>
                            @error('note')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
