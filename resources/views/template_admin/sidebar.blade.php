<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 45px; height: 45px; margin-right: 8px;">
    <div class="sidebar-brand-text">ARSIP DATA</div>
</a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <!-- halaman index -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePendaftaran"
            aria-expanded="false" aria-controls="collapsePendaftaran">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>DATA WARGA</span>
        </a>
        <div id="collapsePendaftaran" class="collapse" aria-labelledby="headingPendaftaran"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('kk.index') }}">KK</a>
                <a class="collapse-item" href="{{ route('akte_nikah.index') }}">AKTE NIKAH</a>
            </div>
        </div>
    </li>

        <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>users</span>
        </a>


        <!-- ...lanjutkan menu sesuai kebutuhan... -->
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
