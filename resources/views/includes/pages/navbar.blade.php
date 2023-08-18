<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <img src="{{ asset('assets/frontend/images/74687588_1006205726396922_8513876472149049344_n.jpg') }}"
            style="width: 70px; border-radius: 40px" alt="Logo" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ route('index1') }}" class="nav-link">Home</a>
                </li>
                <li
                    class="nav-item {{ request()->is('prodcut-home') || request()->is('prodcut-home/details/*') ? 'active' : '' }}">
                    <a href="{{ route('category1') }}" class="nav-link">Product</a>
                </li>
                <li class="nav-item {{ request()->is('') ? 'active' : '' }}">
                    <a href="{{ route('get-index') }}" class="nav-link">My Transaksi</a>
                </li>
                @php
                use App\Models\Cart;
                $user= Auth::id();
                $total = Cart::where('user_id', $user)->count();
                @endphp
                <li class="nav-item {{ request()->is('my-cart') ? 'active' : '' }}">
                    <a href="{{ route('getCart') }}" class="nav-link">
                        Keranjang
                        <span class="badge bg-danger">{{ $total }}</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
                    <a href="{{ route('index-profile') }}" class="nav-link">My Profile</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
