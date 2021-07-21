@extends('layouts.master')
​
@section('title')
    <title>Manajemen Produk</title>
@endsection

@section('css')
    <link href="{{ asset('assets/modules/select2/dist/css/select2.css') }}" rel="stylesheet" />
@endsection
​
@section('content')
    <div class="content-wrapper">
        ​
        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header with-border">
                                <h4 class="card-title">Data Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                <div v-if="message" class="alert alert-success">
                                    Order telah disimpan, Invoice: <strong>#@{{ message }} Silahkan untuk melakukan
                                        konfirmasi pembayaran dihalaman order</strong>
                                </div>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $customer->name }}"
                                        required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Pengiriman</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ $customer->address }}" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Note</label>
                                    <input type="text" name="note" class="form-control" v-model="customer.note" required>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <!-- JIKA VALUE DARI errorMessage ada, maka alert danger akan ditampilkan -->
                                <div v-if="errorMessage" class="alert alert-danger">
                                    @{{ errorMessage }}
                                </div>
                                <!-- JIKA TOMBOL DITEKAN MAKA AKAN MEMANGGIL METHOD sendOrder -->
                                <button class="btn btn-primary btn-sm float-right" :disabled="submitForm"
                                    @click.prevent="sendOrder">
                                    @{{ submitForm ? 'Loading...' : 'Order Now' }}
                                </button>
                            </div>
                        </div>
                    </div>
                    @include('order.cart')
                </div>
            </div>
        </section>
    </div>

@endsection

@section('js')
    <script src="{{ asset('assets/modules/select2/dist/js/select2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
@endsection
