@extends('layouts.master')
@section('title')
    <title>Order</title>
@endsection
@section('content')


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
            <h4>Order</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tbody>
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Total</th>
                            <th>Catatan</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            @if (auth()->user()->role == 'admin')
                                <th>Bukti Pembayaran</th>
                                <th>Action</th>
                            @else
                                <th>Action</th>
                            @endif

                        </tr>
                        <?php $no = 1; ?>
                        @forelse ($data as $row)
                            <tr>
                                <td> {{ $no++ }}</td>
                                <td>
                                    {!! $row->invoice !!}
                                </td>
                                <td>
                                    {{ $row->total }}
                                </td>
                                <td>
                                    {{ $row->note }}
                                </td>
                                <td>
                                    @if ($row->selesai == null)
                                        Belum ditentukan
                                    @endif
                                    {{ $row->selesai }}
                                </td>
                                <td>
                                    {!! $row->status_label !!}
                                    @if (auth()->user()->role == 'customer' && $row->status == 4)
                                        <a href="#" data-id="{{ $row->id }}" class="btn btn-secondary swal-update">
                                            <form action="{{ route('order.diterima', [$row->id]) }}"
                                                id="update{{ $row->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            Klik disini jika pesanan sudah diterima
                                        </a>
                                    @endif
                                </td>
                                @if (auth()->user()->role == 'admin' && $row->status != 0)
                                    <td>
                                        <a href="{{ asset('storage/evidences/' . $row->bukti) }}"> <img
                                                src="{{ asset('assets/img/pdf.png') }}" alt="order" width="20px"> Buka
                                            File</a>
                                    </td>
                                @else
                                    @if (auth()->user()->role == 'admin')
                                        <td>Belum upload pembayaran</td>
                                    @endif

                                @endif
                                <td>
                                    @if (auth()->user()->role == 'admin' && $row->status == 1)

                                        <a href="#" data-id="{{ $row->id }}" class="btn btn-success swal-update">
                                            <form action="{{ route('order.setujui', [$row->id]) }}"
                                                id="update{{ $row->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            Setujui
                                        </a>
                                        <a href="#" data-id="{{ $row->id }}" class="btn btn-danger swal-update">
                                            <form action="{{ route('order.tolak', $row->id) }}"
                                                id="update{{ $row->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            Tolak
                                        </a>
                                    @endif

                                    @if (auth()->user()->role == 'admin' || (auth()->user()->role == 'direktur' && $row->status != 1))

                                        <a href="{{ route('order.edit', [$row->id]) }}" class="btn btn-secondary">

                                            <i class="fa fa-eye"></i>
                                        </a>

                                        @if (auth()->user()->role == 'admin')

                                            <a href="#" data-id="{{ $row->id }}" class="btn btn-danger swal-confirm">
                                                <form action="{{ route('order.destroy', $row->id) }}"
                                                    id="delete{{ $row->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif

                                    @endif

                                    @if (auth()->user()->role == 'customer')
                                        @if ($row->status == 0)
                                            <a href="{{ route('order.edit', [$row->id]) }}"
                                                data-id="{{ $row->id }}" class="btn btn-secondary">
                                                <i class="fa fa-upload"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('order.edit', [$row->id]) }}"
                                                data-id="{{ $row->id }}" class="btn btn-secondary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endif
                                    @endif
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
            swal({
                    title: 'Yakin untuk menghapus data ',
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

        $(".swal-update").click(function(e) {
            var id = e.target.dataset.id;
            swal({
                    title: 'Yakin untuk menyetujui ?',
                    text: 'Data akan disimpan secara permanen!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willUpdate) => {
                    if (willUpdate) {
                        swal('Data berhasil diupdate!', {
                            icon: 'success',
                        });
                        $(`#update${id}`).submit();
                    } else {
                        swal('Dibatalkan');
                    }
                });
        });
    </script>
@endpush
