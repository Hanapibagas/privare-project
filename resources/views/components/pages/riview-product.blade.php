@extends('layouts.app')

@section('title')
Store Success Page
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
        </div>
    </section>

    <section class="store-cart">
        <div class="container">
            <h2 class="mb-1">Payment Informations</h2>
            <form action="{{ route('store-riview-product') }}" method="POST" enctype="multipart/form-data"
                style="margin-top: 20px;">
                @csrf
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Nama Product</label>
                            {{-- <input type="text" class="form-control" name="product_id" /> --}}
                            <select name="product_id" class="form-control">
                                <option value="">-- Silahkan Pilih Product</option>
                                @foreach ( $product as $products )
                                <option value="{{ $products->id }}">{{ $products->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Ulasan</label>
                            <textarea type="text" class="form-control" name="ulasan" /></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-8 col-md-3">
                        <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                            Kirim ulasan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection
