@extends('layouts.master')
@section('title')
    <title>Pemesanan</title>
@endsection
@section('content')

    @if (auth()->user()->role != 'customer')
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image hero-bg-parallax"
                    data-background="../assets/img/unsplash/andre-benz-1214056-unsplash.jpg"
                    style="background-image: url(&quot;../assets/img/unsplash/andre-benz-1214056-unsplash.jpg&quot;);">
                    <div class="hero-inner">
                        <h2>Selamat Datang, {{ auth()->user()->name }}</h2>
                        <p class="lead">Yuk cek order sekarang</p>
                        <div class="mt-4">
                            <a href="{{ route('order.index') }}"
                                class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-cart-plus"></i>
                                Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pesanan</h4>
                        </div>
                        <div class="card-body">
                            {{ $order }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pesanan Di Proses</h4>
                        </div>
                        <div class="card-body">
                            {{ $process }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pesanan Selesai</h4>
                        </div>
                        <div class="card-body">
                            {{ $finished }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Customer</h4>
                        </div>
                        <div class="card-body">
                            {{ $costumer }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image hero-bg-parallax"
                    data-background="../assets/img/unsplash/andre-benz-1214056-unsplash.jpg"
                    style="background-image: url(&quot;../assets/img/unsplash/andre-benz-1214056-unsplash.jpg&quot;);">
                    <div class="hero-inner">
                        <h2>Selamat Datang, {{ auth()->user()->name }}</h2>
                        <p class="lead">Semoga ini hari terbaik kamu, yuk segera order pesanan kamu</p>
                        <div class="mt-4">
                            <a href="{{ route('order.index') }}"
                                class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-cart-plus"></i>
                                Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pesanan</h4>
                        </div>
                        <div class="card-body">
                            {{ $order }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pesanan Di Proses</h4>
                        </div>
                        <div class="card-body">
                            {{ $process }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pesanan Selesai</h4>
                        </div>
                        <div class="card-body">
                            {{ $finished }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
