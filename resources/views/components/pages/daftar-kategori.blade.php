@extends('layouts.app')

@section('title')
Store Homepage
@endsection

@section('content')
<div class="page-content page-home">
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Products {{ $kategori->name }}</h5>
                </div>
            </div>
            <div class="row">
                @foreach ( $products as $file )
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
                    <a href="{{ route('details_products', $file->id) }}" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image"
                                style="background-image: url('{{ Storage::url($file->photo) }}');">
                            </div>
                        </div>
                        <div class="products-text">
                            {{ $file->name }}
                        </div>
                        <div class="products-price">
                            Rp.{{ number_format($file->purchase_price) }}
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection