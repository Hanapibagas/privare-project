@extends('layouts.app')

@section('title')
Store Homepage
@endsection

@push('cs')
<style>
    .carousel {
        width: 100%;
        position: relative;
    }

    .slides img {
        width: 100%;
        display: none;
    }

    .prev,
    .next {
        position: absolute;
        top: 50%;
        font-size: 30px;
        padding: 10px;
        color: white;
        background-color: rgba(0, 0, 0, 0.5);
        cursor: pointer;
        z-index: 1;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }
</style>
@endpush

@section('content')
<div class="page-content page-home">
    <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div class="carousel">
                        <div class="slides">
                            @php
                            $i = 1;
                            @endphp
                            @foreach ( $banner as $files )
                            <img src="{{ Storage::url($files->banner) }}" alt="Image {{ $i++ }}">
                            @endforeach
                        </div>
                        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
                        <a class="next" onclick="changeSlide(1)">&#10095;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Trend Categories</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementCategory = 0 @endphp
                @foreach ( $kategory as $file )
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $incrementCategory+= 100 }}">
                    <a href="{{ route('get.KategoriProduct', $file->id) }}" class="component-categories d-block">
                        <div class="categories-image">
                        </div>
                        <p class="categories-text">
                            {{ $file->name }}
                        </p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Products Terlaris</h5>
                </div>
            </div>
            <div class="row">
                @foreach ( $product as $file )
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
                        <p><small>{{ $file->ProductCategory->name }}</small></p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
<script>
    var slideIndex = 0;
    showSlide(slideIndex);

    function changeSlide(n) {
       showSlide(slideIndex += n);
    }

    function showSlide(n) {
       var slides = document.getElementsByClassName("slides")[0].getElementsByTagName("img");

       if (n >= slides.length) {
          slideIndex = 0;
       } else if (n < 0) {
          slideIndex = slides.length - 1;
       }

       for (var i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
       }

       slides[slideIndex].style.display = "block";
    }

</script>
@endpush