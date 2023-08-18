@extends('layouts.app')

@section('title')
Store Cart Page
@endsection

@section('content')
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
                                Cart
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr />
                </div>
                <div class="col-12">
                    <h2 class="mb-4">Informasi Lengkap</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="store-cart">
        <div class="container">
            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    Daftar Belanja
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="saleTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar Product</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $data as $key => $item )
                                <tr>
                                    <th>{{ $key+ 1 }}</th>
                                    <th>
                                        <img src="{{ Storage::url($item->product->photo) }}" alt="Foto Produk"
                                            class="img-fluid rounded mt-1 mb-1" height="10px" width="80px" />
                                    </th>
                                    <th>{{ $item->product->name }}</th>
                                    <th>Rp. {{ number_format($item->product_price, 0,',',',') }}</th>
                                    <th>{{ $item->quantity }}</th>
                                    <th>Rp. {{ number_format($item->total_price, 0,',',',') }}</th>
                                    <th class="text-right">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success btn-icon icon-left" data-toggle="modal"
                                                data-target="#editItem-{{ $item->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('getDeleteCart', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="btn btn-danger btn-icon icon-left btn-delete">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr />
                </div>
            </div>

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ $error }}
                </div>
            </div>
            @endforeach
            @endif

            <form action="{{ route('getKuponInfo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
                    <div class="col-8">
                        <div class="form-group">
                            <label>voucher tersedia <code>(Jika ada)</code></label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="coupon_code">
                                    <option value="">-- Silahkan pilih --</option>
                                    @foreach ( $coupons as $kupons )
                                    <option value="{{ $kupons->coupon_code }}">{{ $kupons->coupon_code }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Gunakan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ route('getCheckOut') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <h2 class="mb-1">Total Harga</h2>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-md-2">
                        <input type="hidden" name="coupon_code" value="{{ session('coupon_code') }}" />
                        <div class="form-group">
                            <label>Diskon</label>
                            <div class="input-group mb-2">
                                <input type="text" name="discount" class="form-control"
                                    value="{{ session('discount') ? session('discount') : '0' }}" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Potongan Diskon</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" name="discount_price" class="form-control currency" value="0"
                                    readonly />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Sub Total</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" name="sub_total" class="form-control currency"
                                    value="{{ number_format($subTotal) }}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="address_one">Total</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" name="grand_total" class="form-control currency"
                                    value="{{ number_format($subTotal) }}" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address_one">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address_one">Nomor Tlpn</label>
                            <input type="number" class="form-control" maxlength="13"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                name="no_telpn" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address_one">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-control"
                                onchange="showPaymentForm(this.value)">
                                <option value="">-- Pilih metode pembayaran --</option>
                                <option value="COD">COD</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="BCA">BCA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address_one">Bukti Foto
                                <code>(Jika anda memilih pembayaran selain COD)</code></label>
                            <input type="file" class="form-control" name="foto" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address_one">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="paymentForm" style="display: none;">
                            <div class="form-group">
                                <label for="payment_details">Informasi Nomor Rekening</label>
                                <input type="text" name="payment_details" class="form-control"
                                    placeholder="Masukkan nomor rekening" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr />
                    </div>
                </div>
                <div class="col-8 col-md-3">
                    <button type="submit" class="btn btn-success mt-4 px-4 btn-block" id="checkoutButton">
                        Checkout Now
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

@foreach ($data as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="editItem-{{ $item->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('getUpdateCart', $item->id  ) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ $item->product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" class="form-control" value="{{ $item->product->product_code }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}"
                            required />
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('js')
<script>
    function showPaymentForm(selectedValue) {
    var paymentForm = document.getElementById('paymentForm');
    var paymentDetailsInput = document.querySelector('input[name="payment_details"]');

    if (selectedValue === 'COD') {
        paymentForm.style.display = 'none';
        paymentDetailsInput.required = false;
        paymentDetailsInput.value = '';
    } else if (selectedValue === 'BRI') {
        paymentForm.style.display = 'block';
        paymentDetailsInput.required = true;
        paymentDetailsInput.placeholder = '4596-01-025270-53-8';
    } else if (selectedValue === 'BNI') {
        paymentForm.style.display = 'block';
        paymentDetailsInput.required = true;
        paymentDetailsInput.placeholder = '0223383830';
    } else if (selectedValue === 'BCA') {
        paymentForm.style.display = 'block';
        paymentDetailsInput.required = true;
        paymentDetailsInput.placeholder = '0143000091';
    } else {
        paymentForm.style.display = 'none';
        paymentDetailsInput.required = false;
        paymentDetailsInput.value = '';
    }
}
</script>
<script src="{{ url('assets/backend/js/cleave.min.js') }}"></script>
<script src="{{ url('assets/backend/js/my_cleave.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tableBody = document.querySelector('#saleTable tbody');

        if (tableBody.childElementCount === 0) {
            var checkoutButton = document.querySelector('#checkoutButton');
            checkoutButton.disabled = true;
        }
    });
</script>
<script>
    $(document).ready(function() {

        function currencyFormat(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        let discount = $('[name="discount"]').val();
        let discountPrice = $('[name="discount_price"]');
        let subTotal = $('[name="sub_total"]').val().replace(/,/g, '');
        let grandTotal = $('[name="grand_total"]');
        let paid = $('[name="paid"]');
        let change = $('[name="change"]');
        let priceDisplay = $('.priceDisplay');

        let sumDiscountPrice = subTotal * discount / 100;

        discountPrice.val(currencyFormat(sumDiscountPrice));
        grandTotal.val(currencyFormat(subTotal - sumDiscountPrice));
        priceDisplay.html(currencyFormat(subTotal - sumDiscountPrice));

        paid.on('input', function() {
            paidValue = paid.val().replace(/,/g, '');
            changeValue = paidValue - grandTotal.val().replace(/,/g, '');

            if (changeValue < 0) {
                change.val(0)
            } else {
                change.val(currencyFormat(changeValue));
            }

            if (paidValue >= (subTotal - sumDiscountPrice)) {
                $(':input[id="createTransaction"]').prop('disabled', false);
            } else {
                $(':input[id="createTransaction"]').prop('disabled', true);
            }
        });
    });
</script>
@endpush