@extends('layouts.master')
@section('title')
    <title>Upload Faktur dan Surat Jalan</title>
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
        <form action="{{ route('delivery.store', [$order->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4>Upload Faktur dan Surat Jalan</h4>
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Upload Faktur</label>
                            <input type="file" class="form-control" value="{{ old('faktur') }}" name="faktur"
                                id="faktur">

                            @error('faktur')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Upload Surat Jalan</label>
                            <input type="file" class="form-control" value="{{ old('surat_jalan') }}" name="surat_jalan"
                                id="surat_jalan">

                            @error('surat_jalan')
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
    <script type="text/javascript">
        $(document).ready(function(e) {


            $('#sampul').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>
@endpush
