@extends('layouts.app')

@section('title')
Store Success Page
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

<div class="page-content page-cart">
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
                                Cart
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-cart">
        <div class="container">
            <h2 class="mb-1">Profile Informations</h2>
            <form action="{{ route('update-password-profile') }}" method="POST" enctype="multipart/form-data"
                style="margin-top: 20px;">
                @csrf
                @method('PUT')
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Nama</label>
                            <input type="text" class="form-control" value="{{ $users->name }}" name="name" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Nomor Telpon</label>
                            <input type="text" class="form-control" name="no_telpon" value="{{ $users->no_telpon }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $users->email  }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Alamat</label>
                            <textarea type="text" class="form-control" name="alamat" />{{ $users->alamat }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password_confirmation" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-8 col-md-3">
                        <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                            Update Profile
                        </button>
                    </div>
                </div>
            </form>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-8 col-md-3">
                        <button type="submit" class="btn btn-danger mt-4 px-4 btn-block">
                            Log Out
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection