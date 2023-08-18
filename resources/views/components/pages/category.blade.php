@extends('layouts.app')

@section('title')
Store Category Page
@endsection

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
<div class="page-content page-home">

    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Products</h5>
                </div>
                <div style="margin-left: 839px;">
                    <form action="{{ route('getPencarian') }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Ingin mencari sesuatu ?">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @php $incrementProduct = 0 @endphp
                @foreach ( $product as $file )
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct+= 100 }}">
                    <a href="{{ route('details_products', $file->id) }}" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="
                                    background-image: url('{{ Storage::url($file->photo) }}')
                            "></div>
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
            <div class="row">
                <div class="col-12 mt-4">
                    {{-- {{ $products->links() }} --}}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection