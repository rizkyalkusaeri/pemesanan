@extends('layouts.master')
@section('title')
    <title>Manajemen Bahan Baku</title>
@endsection
@section('content')
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'gudang')
        <a href="{{ route('bahan.create') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i>
            Tambah
            Bahan Baku</a>
        <br>
    @endif
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
            <h4>Bahan Baku</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Bahan Baku</td>
                            <td>Stok</td>
                            <td>Keterangan</td>
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'gudang')
                                <td>Action</td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @forelse ($bahan as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->stock }}</td>
                                <td>{{ $row->additional }}</td>
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'gudang')
                                    <td>
                                        <a href="{{ route('bahan.edit', $row->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-id="{{ $row->id }}" data-nama="{{ $row->name }}"
                                            class="btn btn-danger swal-confirm">
                                            <form action="{{ route('bahan.destroy', $row->id) }}"
                                                id="delete{{ $row->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
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
