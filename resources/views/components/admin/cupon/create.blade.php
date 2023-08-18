@extends('layouts.admin')

@section('title')
Cupon
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah cupon</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('store_cupon') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
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
                                    <input type="text"
                                        class="form-control coupon @error('coupon_code') is-invalid @enderror"
                                        onkeyup="this.value = this.value.toUpperCase();"
                                        onkeypress="return event.charCode != 32" name="coupon_code"
                                        value="{{ old('coupon_code') }}">
                                    @error('coupon_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <input type="date" name="expired"
                                        class="form-control @error('expired') is-invalid @enderror"
                                        value="{{ old('expired') }}" />
                                    @error('expired')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <select class="form-control " name="status">
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
                                    <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                        name="discount" onKeyPress="if(this.value >= 100) return false;"
                                        value="{{ old('discount') }}" />
                                    @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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