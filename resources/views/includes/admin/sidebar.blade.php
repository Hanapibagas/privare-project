<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index1') }}">
        <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('dashboard-admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard_index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li
        class="nav-item {{ request()->is('category') || request()->is('riview') || request()->is('riview/details/*') || request()->is('category') || request()->is('category/update/*') ||
            request()->is('category/create') || request()->is('coupon') || request()->is('coupon/edit/*') || request()->is('coupon/create') || request()->is('product')
            || request()->is('product/edit/*') || request()->is('product/create') || request()->is('category/create') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Products</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Products:</h6>
                <a class="collapse-item {{ request()->is('product') || request()->is('product/edit/*') || request()->is('product/create') ? 'active' : '' }}"
                    href="{{ route('index_product') }}">Tambah Product</a>
                <a class="collapse-item {{ request()->is('riview') || request()->is('riview/details/*') ? 'active' : '' }}"
                    href="{{ route('index-riview') }}">Review Product</a>
                <a class="collapse-item {{ request()->is('coupon') || request()->is('coupon/edit/*') || request()->is('coupon/create') ? 'active' : '' }}"
                    href="{{ route('index_cupon') }}">Tambah Voucher</a>
                <a class="collapse-item {{ request()->is('category') || request()->is('category/update/*') || request()->is('category/create') ? 'active' : '' }}"
                    href="{{ route('index_category') }}">Tambah Kategori</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('banner') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('index_banner') }}">
            <i class="fas fa-fw fa-image"></i>
            <span>Slide</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('daftar-costumer') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('index_costumer') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Daftar Customer</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('list-pertanyaan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('get.Index.List') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Daftar Pertanyaan Customer</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('transaksi') || request()->is('transaksi/details/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('index-transaksi') }}">
            <i class="fas fa-fw fa-list-ul"></i>
            <span>Daftar Transaksi</span></a>
    </li>
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>