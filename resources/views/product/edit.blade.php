@extends('layouts.master')
@section('title')
    <title>Update Produk</title>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('product.update', [$data->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-header">
                <h4>Produk</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" @if (old('name')) value="{{ old('name') }}" @else value="{{ $data->name }}" @endif name="name">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" @if (old('price')) value="{{ old('price') }}" @else value="{{ $data->price }}" @endif name="price">
                            @error('price')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" value="{{ old('photo') }}" name="photo" id="photo">
                            <br />

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12 mb-2">
                                        <img id="preview-image-before-upload"
                                            src="{{ asset('storage/products/' . $data->photo) }}"
                                            alt="{{ $data->name }}" style="max-height: 150px;">
                                    </div>
                                </div>
                            </div>
                            <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>

                            @error('foto')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ukuran <b>(contoh : L,XL,XXL)</b></label>
                            <input type="text" class="form-control" @if (old('size')) value="{{ old('size') }}" @else value="{{ $data->size }}" @endif name="size">
                            @error('price')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea cols="30" rows="10" id="description" class="form-control"
                                name="description">@if (old('description')) {{ old('description') }} @else {{ $data->description }} @endif</textarea>
                            @error('description')
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
@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function(e) {


            $('#photo').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>
@endpush
