@extends('layouts.master')
@section('title')
    <title>Invoice</title>
@endsection
@section('content')

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
                            <th>Invoice</th>
                            <th>Total</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Tanggal Selesai</th>
                            <th>Detail</th>
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'ppic')
                                <th>Faktur & Surat Jalan</th>
                            @endif
                        </tr>
                        <?php $no = 1; ?>
                        @forelse ($order as $row)
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
                                    {!! $row->status_label !!}
                                </td>
                                <td>
                                    @if ($row->selesai == null)
                                        Belum ditentukan
                                    @endif
                                    {{ $row->selesai }}
                                </td>
                                <td>
                                    <a href="{{ route('delivery.show', [$row->id]) }}" class="btn btn-secondary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>

                                @if ($row->delivery != null)
                                    <a href="{{ asset('storage/deliveries/' . $row->delivery->faktur) }}">Faktur</a>
                                    <br>
                                    <a href="{{ asset('storage/deliveries/' . $row->delivery->surat_jalan) }}">Surat
                                        Jalan</a>
                                @else
                                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'ppic')
                                        <td> <a href="{{ route('delivery.create', [$row->id]) }}"
                                                data-id="{{ $row->id }}" class="btn btn-success">
                                                Upload Faktur dan Surat Jalan
                                            </a>
                                        </td>
                                    @endif
                                @endif

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Belum ada data</td>
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
