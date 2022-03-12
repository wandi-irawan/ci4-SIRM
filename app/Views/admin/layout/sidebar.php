<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIRM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= url_is('dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Daftar Menu
    </div>

    <!-- data pasien -->
    <li class="nav-item <?= url_is('pasien*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('pasien'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pasien</span></a>
    </li>

    <!-- data poli -->
    <li class="nav-item <?= url_is('poli*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('poli'); ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Data Poli</span></a>
    </li>

    <!-- data poli -->
    <li class="nav-item <?= url_is('obat*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('obat'); ?>">
            <i class="fas fa-fw fa-cannabis"></i>
            <span>Data Obat</span></a>
    </li>


    <!-- data dokter -->
    <li class="nav-item <?= url_is('dokter*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dokter'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Data dokter</span></a>
    </li>

    <!-- laporan -->
    <li class="nav-item <?= url_is('laporan*') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('laporan'); ?>">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Data Laporan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->