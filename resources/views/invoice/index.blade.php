@extends('layouts.master')
@section('title')
    <title>Invoice</title>
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
            <h4>Invoice</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tbody>
                        <tr>
                            <th>No</th>
                            <th>Job Order</th>
                            <th>Status</th>
                            <th>Invoice</th>
                            <th>Bukti Pembayaran</th>
                            <th>Action</th>
                        </tr>
                        <?php $no = 1; ?>
                        @forelse ($order as $row)
                            <tr>
                                <td> {{ $no++ }}</td>
                                <td>
                                    <a href="{{ asset('storage/jobs/' . $row->job) }}"> <img
                                            src="{{ asset('assets/img/pdf.png') }}" alt="order" width="20px"> Buka
                                        File</a>
                                </td>
                                <td>
                                    {!! $row->status_produksi !!}
                                </td>
                                <td>
                                    @if ($row->invoice != null)
                                        <a href="{{ asset('storage/invoices/' . $row->invoice->file) }}"> <img
                                                src="{{ asset('assets/img/pdf.png') }}" alt="order" width="20px">Buka
                                            Invoice</a>
                                    @else
                                        <a href="{{ route('invoice.create', [$row->id]) }}"> Upload Invoice </a>
                                    @endif
                                </td>
                                @if (auth()->user()->role == 'customer')
                                    <td>
                                        <a href="{{ route('invoice.edit', [$row->id]) }}" data-id="{{ $row->id }}"
                                            class="btn btn-success">
                                            Upload Bukti Pembayaran
                                        </a>
                                    </td>
                                @else
                                    @if ($row->evidence != null)
                                        <td>
                                            <a
                                                href="{{ asset('storage/evidences/' . $row->evidence->bukti) }}">{{ $row->evidence->bukti }}</a>
                                        </td>
                                    @else
                                        <td>
                                            <p>Belum Upload Pembayaran</p>
                                        </td>
                                    @endif
                                    <td> <a href="#" data-id="{{ $row->id }}" class="btn btn-success swal-update">
                                            <form action="{{ route('invoice.setuju', [$row->id]) }}"
                                                id="update{{ $row->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            Setujui
                                        </a></td>
                                @endif
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
