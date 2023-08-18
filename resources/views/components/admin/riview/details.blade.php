@extends('layouts.admin')

@section('title')
Riview
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Details riview</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" readonly value="{{ $riview->Product->name }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Pengguna</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control currency" value="{{ $riview->User->name }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Ulasan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>
                            <textarea rows="8" type="text" class="form-control currency"
                                name="stock">{{ $riview->ulasan }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
<script src="{{ url('assets/backend/js/image_upload.js') }}"></script>
@endpush