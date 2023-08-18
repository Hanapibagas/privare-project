<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('assets/backend/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<style>
    .bg-gradient {
        background-color: pink;
    }
</style>

<body class="bg-gradient">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block">
                        <img style="margin-top: 80px; margin-left: 110px; width: 250px"
                            src="{{ asset('assets/frontend/images/74687588_1006205726396922_8513876472149049344_n.jpg') }}"
                            alt="">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{ route('register') }}" method="POST" class="user">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="name"
                                            class="form-control form-control-user @error('name') is-invalid @enderror"
                                            id="exampleFirstName" placeholder="Nama Lengkap">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" name="no_telpon"
                                            class="form-control form-control-user @error('no_telpon') is-invalid @enderror"
                                            id="exampleLastName" placeholder="Nomor tlpn" maxlength="13">
                                        @error('no_telpon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        id="exampleInputEmail" placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="alamat"
                                        class="form-control form-control-user @error('alamat') is-invalid @enderror"
                                        id="exampleInputPassword" placeholder="Alamat">
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="password" type="password" class="form-control form-control-user"
                                            name="password" required autocomplete="new-password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="password-confirm" type="password"
                                            class="form-control form-control-user" placeholder="Ketik Ulang Password"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('asstes/backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asstes/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asstes/backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('asstes/backend/js/sb-admin-2.min.js') }}"></script>

</body>

</html>