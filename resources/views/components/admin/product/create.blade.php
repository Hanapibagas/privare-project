@extends('layouts.admin')

@section('title')
Product
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah product</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Pratinjau Foto</label>
                                <img src="{{ url('assets/backend/img/image_not_available.png') }}"
                                    class="rounded img-responsive" alt="Image Preview" width="100%" id="img-preview">
                            </div>
                            <div class="form-group">
                                <label class="float-right">
                                    <a href="#" data-toggle="tooltip"
                                        title="Klik untuk menghapus foto yang sudah dipilih" style="display:none"
                                        id="img-reset">
                                        <code class="text-right">Hapus Foto</code>
                                    </a>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-file-image"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="photo" id="img-file"
                                            required>
                                        <label class="custom-file-label" id="img-name">Pilih Foto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Kategori</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="category_id" id="category-select" required>
                                        <option value="">-- Silahkan Pilih --</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" data-name="{{ $category->name }}">
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kode Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="product_code" id="product-code-input"
                                        readonly>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label>Nama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Stok</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                    </div>
                                    <input type="number"
                                        class="form-control currency @error('stock') is-invalid @enderror" name="stock">
                                    @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    Harga Beli
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <b>Rp</b>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="form-control currency @error('purchase_price') is-invalid @enderror"
                                        name="purchase_price">
                                    @error('purchase_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    Harga Jual
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <b>Rp</b>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="form-control currency @error('selling_price') is-invalid @enderror"
                                        name="selling_price">
                                    @error('selling_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 offset-2">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
</script>
<script src="{{ url('assets/backend/js/cleave.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
<script src="{{ url('assets/backend/js/image_upload.js') }}"></script>
<script src="{{ url('assets/backend/js/my_cleave.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#category-select').on('change', function () {
            var category = $(this).val();
            var codeInput = $('#product-code-input');
            var abbreviation = getAbbreviation(category);

            codeInput.val(abbreviation);
        });

        function getAbbreviation(category) {
            var categories = {!! $categories !!};
            var abbreviation = '';

            for (var i = 0; i < categories.length; i++) {
                if (categories[i].id == category) {
                    var categoryName = categories[i].name;
                    var words = categoryName.split(' ');

                    for (var j = 0; j < words.length; j++) {
                        abbreviation += words[j].charAt(0);
                    }

                    break;
                }
            }

            return abbreviation.toUpperCase();
        }
    });
</script>
@endpush