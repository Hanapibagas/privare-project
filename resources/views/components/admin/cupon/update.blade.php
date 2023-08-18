@extends('layouts.admin')

@section('title')
Cupon
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update cupon</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('update_cupon', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kode Kupon</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control coupon"
                                        onkeyup="this.value = this.value.toUpperCase();"
                                        onkeypress="return event.charCode != 32" name="coupon_code"
                                        value="{{ $item->coupon_code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Expired</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-times"></i>
                                        </div>
                                    </div>
                                    <input type="date" name="expired" class="form-control"
                                        value="{{ $item->expired }}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg">
                            <div class="form-group">
                                <label for="">Status</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="status">
                                        <option value="{{ $item->status }}">{{ $item->status }}</option>
                                        <option value="">-- silahkan pilih jika mau diubah --</option>
                                        <option value="0" {{ old('status')==0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        <option value="1" {{ old('status')==0 ? 'selected' : '' }}>Aktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Discount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-percentage"></i>
                                        </div>
                                    </div>
                                    <input type="number" class="form-control" name="discount"
                                        onKeyPress="if(this.value >= 100) return false;" value="{{ $item->discount}}" />
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