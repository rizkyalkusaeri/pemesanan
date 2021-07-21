@extends('layouts.master')
@section('title')
    <title>Product</title>
@endsection
@section('content')
    @if (auth()->user()->role == 'admin')
        <a href="{{ route('product.create') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i>
            Tambah
            Data</a>
    @endif
    <br>
    <br>
    @if (session('message'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{ session('message') }}
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4>Product</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tbody>
                        <tr>
                            <th>Nama (ukuran)</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            @if (auth()->user()->role == 'admin')
                                <th>Action</th>
                            @endif
                        </tr>
                        @forelse ($products as $row)
                            <tr>
                                <td>{{ $row->name . ' (' . $row->size . ')' }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->price }}</td>
                                <td>
                                    <img src="{{ asset('storage/products/' . $row->photo) }}" width="100px" height="100px"
                                        alt="{{ $row->name }}">
                                </td>
                                @if (auth()->user()->role == 'admin')

                                    <td>
                                        <a href="{{ route('product.edit', [$row->id]) }}" class="btn btn-success">Edit</a>
                                        <a href="#" data-id="{{ $row->id }}" data-nama="{{ $row->name }}"
                                            class="btn btn-danger swal-confirm">
                                            <form action="{{ route('product.destroy', $row->id) }}"
                                                id="delete{{ $row->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            Delete
                                        </a>

                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak ada data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{-- {{$data->links()}} --}}
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">

            </nav>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>

@endpush

@push('after-scripts')
    <script>
        $(".swal-confirm").click(function(e) {
            var id = e.target.dataset.id;
            var nama = e.target.dataset.nama;
            swal({
                    title: 'Yakin untuk menghapus data ' + nama + '?',
                    text: 'Sekali hapus, maka data akan terhapus permanen!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal('Data berhasil dihapus!', {
                            icon: 'success',
                        });
                        $(`#delete${id}`).submit();
                    } else {
                        swal('Data tidak dihapus');
                    }
                });
        });
    </script>
@endpush
