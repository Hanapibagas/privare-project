<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index1') }}">
        <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('dashboard-admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard-owner') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('transaksi-owner') || request()->is('transaksi/details/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('index-owner') }}">
            <i class="fas fa-fw fa-list-ul"></i>
            <span>Daftar Transaksi</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ request()->is('list-laporan') || request()->is('transaksi/details/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('get.Index.Laporan') }}">
            <i class="fas fa-fw fa-list-ul"></i>
            <span>Daftar Laporan</span></a>
    </li>
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>