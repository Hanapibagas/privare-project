@extends('layouts.app')

@section('content')
@if (session('status'))
<script>
    Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: "{{ session('status') }}",
            });
</script>
@endif
<div class="page-content page-cart">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                My Transaksi
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="card" style="margin-top: 20px;">
            <style>
                .customer-silver {
                    background-color: #C0C0C0;
                    color: #000000;
                    padding: 10px;
                    border-radius: 5px;
                }

                .customer-gold {
                    background-color: #FFD700;
                    color: #000000;
                    padding: 10px;
                    border-radius: 5px;
                }

                .customer-platinum {
                    background-color: #E5E4E2;
                    color: #000000;
                    padding: 10px;
                    border-radius: 5px;
                }

                .customer-regular {
                    background-color: #FFFFFF;
                    color: #000000;
                    padding: 10px;
                    border-radius: 5px;
                }
            </style>
            <div class="icon-left @if ($user->tanda === 'Silver') customer-silver
                @elseif ($user->tanda === 'Gold') customer-gold @elseif ($user->tanda === 'Platinum') customer-platinum
                @else customer-regular @endif">
                @if ($user->tanda === 'Silver')
                <p style="text-align: center;">Anda adalah Customer Silver</p>
                @elseif ($user->tanda === 'Gold')
                <p style="text-align: center;">Anda adalah Customer Gold</p>
                @elseif ($user->tanda === 'Platinum')
                <p style="text-align: center;">Anda adalah Customer Platinum</p>
                @else
                <p style="text-align: center;">Anda adalah Customer Reguler</p>
                @endif
            </div> <br>
            <div class="card-header">
                Daftar Belanja
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="saleTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Pemesanan</th>
                                <th scope="col">Nama Akun</th>
                                <th scope="col">Metode Pembayaran</th>
                                <th scope="col">Status</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $transaksi as $key => $items )
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <th>{{ $items->kode_pemesanan }}</th>
                                <th>{{ $items->user->name }}</th>
                                <th>{{ $items->metode_pembayaran }}</th>
                                <th>
                                    <span class="badge badge-{{ $items->status == 1 ? 'success' : 'secondary'}}">
                                        {{ $items->status == 1 ? 'Sudah di proses' : 'Sedang di proses'}}
                                    </span>
                                </th>
                                <th>
                                    <button class="btn btn-success btn-icon icon-left" data-toggle="modal"
                                        data-target="#editItem-{{ $items->id }}">
                                        <i class="fas fa-eye-slash"></i> Details
                                    </button>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($transaksi as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="editItem-{{ $item->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('get.UpdateTransaksi', $item->id  ) }}" enctype="multipart/form-data" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ $item->nama_lengkap }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap :</label>
                        <h7 class="modal-title">{{ $item->nama_lengkap }}</h7>
                    </div>
                    <div class="form-group">
                        <label>Diskon :</label>
                        <h7 class="modal-title">{{ $item->discount }}%</h7>
                    </div>
                    <div class="form-group">
                        <label>Potongan Diskon :</label>
                        <h7 class="modal-title">Rp.{{ number_format($item->discount_price) }}</h7>
                    </div>
                    <div class="form-group">
                        <label>Total :</label>
                        <h7 class="modal-title">Rp.{{ number_format($item->grand_total) }}</h7>
                    </div>
                    <div class="form-group">
                        <label>Product :</label>
                        @foreach ( $item->detailTransaksi as $details )
                        <h7 class="modal-title">{{ $details->Product->name }}</h7>,
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Total Product :</label>
                        @foreach ( $item->detailTransaksi as $details )
                        <h7 class="modal-title">{{ $details->jumlah_barang }}</h7>,
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Pesanan Diterima :</label>
                        <input type="file" name="foto" accept=".jpg, .png" class="form-control">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-secondary" ">Kirim</button>
                    <button type=" button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection