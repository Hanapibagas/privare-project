@extends('layouts.admin')

@section('title')
Costumer
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
        <h1 class="h3 mb-0 text-gray-800">Daftar customer</h1>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Kirim promosi
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
        Kirim laporan
    </button>
    <a href="{{ route('get.Cetak.PDF') }}" target="_blank" class="btn btn-danger">
        <i class="fa fa-print"></i> Cetak daftar customer
    </a>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Jumlah Belanja</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <style>
                            .customer-silver {
                                background-color: silver;
                                color: black;
                                padding: 10px;
                                border-radius: 5px;
                                margin-bottom: 10px;
                            }

                            .customer-gold {
                                background-color: gold;
                                color: black;
                                padding: 10px;
                                border-radius: 5px;
                                margin-bottom: 10px;
                            }

                            .customer-platinum {
                                background-color: #e5e4e2;
                                color: black;
                                padding: 10px;
                                border-radius: 5px;
                                margin-bottom: 10px;
                            }
                        </style>
                        @foreach ( $users as $key => $files )
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <th>{{ $files->name }}</th>
                            <th>{{ $files->email }}</th>
                            <th>{{ $files->alamat }}</th>
                            <th>{{ $totalTransactions[$files->id] }}</th>
                            <th class="customer-{{ $files->tanda }}"> {{ $files->tanda }}</th>
                            <th>
                                <input type="hidden" class="delete_id" value="{{ $files->id }}">
                                <form action="{{ route('destroy_category', $files->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btndelete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('post.Laporan.Costumer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="subject">Subject:</label>
                        <input class="form-control" type="text" name="ket" id="subject" required>
                        <br>
                        <label for="message">File:</label>
                        <input class="form-control" type="file" name="file" id="subject">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kirim-email-ke-seluruh-user') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="subject">Subject:</label>
                        <input class="form-control" type="text" name="subject" id="subject" required>
                        <br>
                        <label for="message">Message:</label>
                        <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Kirim Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
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
                            url: 'category/delete/' + deleteid,
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