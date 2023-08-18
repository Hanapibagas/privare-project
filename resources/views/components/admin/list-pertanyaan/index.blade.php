@extends('layouts.admin')

@section('title')
Listpertanyaan
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
        <h1 class="h3 mb-0 text-gray-800">List Pertanyaan customer</h1>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $list as $key => $files )
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <th>{{ $files->user->name }}</th>
                            <th>{{ date('d F Y', strtotime($files->tanggal)) }}</th>
                            <th>
                                <a data-toggle="modal" data-target="#exampleModal-{{ $files->id }}"
                                    class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ( $list as $lists )
    <div class="modal fade" id="exampleModal-{{ $lists->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hasil Pertanyaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>1. Bagaimana anda menilai kemudahan akses dan kegunaan website toko yayyshop dalam
                            memesan
                            produk?</label>
                        <h7 class="modal-title"><b>{{ $lists->q1 }}</b></h7>
                    </div>
                    <div class="form-group">
                        <label>2. Seberapa baik layanan website toko yayyshop dalam membantu menampilkan informasi yang
                            diperlukan?</label>
                        <h7 class="modal-title"><b>{{ $lists->q2 }}</b></h7>
                    </div>
                    <div class="form-group">
                        <label>3. Seberapa lengkap produk-produk yang ditawarkan oleh toko yayyshop?</label>
                        <h7 class="modal-title"><b>{{ $lists->q3 }}</b></h7>
                    </div>
                    <div class="form-group">
                        <label>4. Seberapa menarik promo-promo yang sering dirilis oleh toko yayyshop?</label>
                        <h7 class="modal-title"><b>{{ $lists->q4 }}</b></h7>
                    </div>
                    <div class="form-group">
                        <label>5. Apakah admin toko yayyshop cepat dan tanggap dalam melayani pemesanan dan chat para
                            customer?</label>
                        <h7 class="modal-title"><b>{{ $lists->q5 }}</b></h7>
                    </div>
                    <div class="form-group">
                        <label>6. Seberapa memuaskan layanan kami dalam membantu menyelesaikan masalah anda?</label>
                        <h7 class="modal-title"><b>{{ $lists->q6 }}</b></h7>
                    </div>
                    <div class="form-group">
                        <label>7. Apakah anda akan merekomendasikan toko yayyshop kepada oranglain?</label>
                        <h7 class="modal-title"><b>{{ $lists->q7 }}</b></h7>
                    </div>
                    <div class="form-group">
                        <label>8. Bagaimana kami dapat meningkatkan pengalaman anda? Silahkan berikan kritik dan saran
                            anda.</label>
                        <h7 class="modal-title"><b>{{ $lists->q8 }}</b></h7>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
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