@extends('layouts.admin')

@section('title')
Banner
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah banner</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('store_banner') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

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

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Pratinjau Foto</label>
                                <img src="{{ url('assets/backend/img/image_not_available.png') }}"
                                    class="rounded img-responsive" alt="Image Preview" width="100%" id="img-preview">
                            </div>
                        </div>
                        <div class="col-lg-4" style="margin-top: 34px;">
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
                                        <input type="file" class="custom-file-input" name="banner" id="img-file">
                                        <label class="custom-file-label" id="img-name">Pilih Foto</label>
                                    </div>
                                </div>
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
<script src="{{ url('assets/backend/js/cleave.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
<script src="{{ url('assets/backend/js/image_upload.js') }}"></script>
<script src="{{ url('assets/backend/js/my_cleave.js') }}"></script>
@endpush