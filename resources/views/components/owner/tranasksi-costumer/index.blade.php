@extends('layouts.owner')

@section('title')
Transaksi
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.css" />
@endpush

@section('content')
@if (session('status'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text : "{{ session('status') }}",
    });
</script>
@endif

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar transaksi</h1>
        <form action="{{ route('getExportPDF') }}" method="POST" target="_blank">
            @csrf
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label class="col-form-label">Dari</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" name="dari" required>
                </div>
                <div class="col-auto">
                    Ke
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" name="ke" required>
                </div>
                <div class="col-auto">
                    <button class="btn btn-danger" type="submit">Print PDF</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal order</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah barang</th>
                            <th scope="col">Harga jual</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Harga beli</th>
                            <th scope="col">Untung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $transaksi as $items )
                        <tr>
                            <th>{{ $items->order_date }}</th>
                            <th>{{ $items->Product->name }}</th>
                            <th>{{ $items->jumlah_barang }}</th>
                            <th>Rp.{{ number_format($items->selling_price) }}</th>
                            <th>{{ $items->discount }}%</th>
                            <th>Rp.{{ number_format($items->purchase_price) }}</th>
                            <th>Rp.{{ number_format($items->profit) }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btndelete').click(function (e) {
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat memulihkan data ini lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deleteid,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: 'product/delete/' + deleteid,
                            data: data,
                            success: function (response) {
                                swal(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        });

    });

</script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endpush
