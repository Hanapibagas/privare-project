@extends('layouts.app')

@section('title')
Store Cart Page
@endsection

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
                                Cart
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-cart">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr />
                </div>
                <div class="col-12">
                    <h2 class="mb-4">Shipping Details</h2>
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_one">Address 1</label>
                            <input type="text" class="form-control" id="address_one" name="address_one"
                                value="Setra Duta Cemara" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_two">Address 2</label>
                            <input type="text" class="form-control" id="address_two" name="address_two"
                                value="Blok B2 No. 34" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinces_id">Province</label>
                            <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id"
                                v-if="provinces">
                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                            </select>
                            <select v-else class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="regencies_id">City</label>
                            <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id"
                                v-if="regencies">
                                <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
                            </select>
                            <select v-else class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Postal Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="40512" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="Indonesia" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Mobile</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="+628 2020 11111" />
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-1">Payment Informations</h2>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-4 col-md-2">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Country Tax</div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Product Insurance</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Ship to Jakarta</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title text-success">${{ number_format($totalPrice ?? 0) }}</div>
                        <div class="product-subtitle">Total</div>
                    </div>
                    <div class="col-8 col-md-3">
                        <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                            Checkout Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('js')
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        var couponSelect = document.querySelector('select[name="coupon_code"]');
        var discountPercentage = 0; // Persentase diskon
        var discountAmount = 0; // Potongan harga

        couponSelect.addEventListener('change', function () {
            var selectedOption = couponSelect.options[couponSelect.selectedIndex];
            discountPercentage = parseFloat(selectedOption.dataset.discount);
            discountAmount = parseFloat(selectedOption.dataset.amount);

            calculateTotal();
        });

        function calculateTotal() {
            var totalElement = document.getElementById('total');
            var subtotalElement = document.querySelector('.product-title.text-success');
            var subtotal = 0;

            var rows = document.getElementById('saleTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var price = parseFloat(row.cells[3].textContent.trim().replace('Rp. ', '').replace(',', ''));
                var quantity = parseInt(row.cells[4].textContent.trim());
                var rowTotal = price * quantity;

                subtotal += rowTotal;
            }

            var discount = subtotal * (discountPercentage / 100);
            var total = subtotal - discount - discountAmount;

            subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString('id-ID');
            totalElement.textContent = 'Rp. ' + total.toLocaleString('id-ID');
        }
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var table = document.getElementById('saleTable');
        var totalElement = document.getElementById('total');

        function updateTotal() {
            var total = 0;
            var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var price = row.cells[3].textContent.trim().replace('Rp. ', '').replace(',', '');
                var quantity = row.cells[4].textContent.trim();
                var rowTotal = parseFloat(price) * parseInt(quantity);

                total += rowTotal;
            }

            totalElement.textContent = 'Rp.' + total.toLocaleString('id-ID');
        }

        updateTotal();

        table.addEventListener('input', function (event) {
            var element = event.target;

            if (element.tagName === 'INPUT' && element.name === 'quantity') {
                updateTotal();
            }
        });
    });
</script>
@endpush