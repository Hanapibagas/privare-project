@extends('layouts.app')

@section('title')
Store Details Page
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

@if (session('warning'))
<script>
    Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: "{{ session('warning') }}",
            });
</script>
@endif
<div class="page-content page-details">
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
                                Product Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-gallery mb-3" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="zoom-in">
                    <transition name="slide-fade" mode="out-in">
                        <img style="width: 300px;" src="{{ Storage::url($product->photo) }}" class="" alt="" />
                    </transition>
                </div>
            </div>
        </div>
    </section>

    <div class=" store-details-container" data-aos="fade-up">
        <form action="{{ route('storeCart', $product->id) }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="product_price">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->name }} </h1>
                            <div class="price">Rp.{{ number_format($product->purchase_price) }}</div>
                        </div>
                        <div class="col-lg-2" data-aos="zoom-in">
                            <p>Stok : {{ $product->stock }}</p>
                            <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3">
                                Masukkan Ke keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <section class="store-description">
            <div class="container">
                <div class="row" style="margin-top: -7px;">
                    <div class="col-12 col-lg-8">
                        {!! $product->deskripsi !!}
                    </div>
                </div>
            </div>
        </section>
        <section class="store-review">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mt-3 mb-3">
                        <h5>Customer Review ({{ $jumlah }})</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <ul class="list-unstyled">
                            @forelse ( $riview as $riviews )
                            <li class="media">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt=""
                                    class="mr-3 rounded-circle" />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">{{ $riviews->User->name }}</h5>
                                    {{ $riviews->ulasan }}
                                </div>
                            </li>
                            @empty
                            <li>
                                <h2>Belum Ada Ulasan</h2>
                            </li>
                            @endforelse
                            <div class="row" data-aos="fade-up" data-aos-delay="200">
                                {{-- <div class="col-8 col-md-3">
                                    <a href="" class="btn btn-secondary mt-4 px-4 btn-block">
                                        See more
                                    </a>
                                </div> --}}
                                <div class="col-8 col-md-3">
                                    <a href="{{ route('riview-product') }}" class="btn btn-success mt-4 px-4 btn-block">
                                        give a review
                                    </a>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/frontend/vendor/vue/vue.js') }}"></script>
{{-- <script>
    var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach ($product->Gallery as $gallery)
            {
              url: "{{ Storage::url($gallery->name) }}",
            },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
</script> --}}
@endpush