@extends('layouts.admin')

@section('title')
Category
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update kategori</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('update_category', $files->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Kategori</label>
                    <input type="text" value="{{ $files->name }}"
                        class="form-control @error('name') is-invalid @enderror" name="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Update kategori
                </button>
            </form>
        </div>
    </div>
</div>
@endsection