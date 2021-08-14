<div class="nav accordion" id="accordionSidenav">
    <a class="nav-link " href="<?php echo site_url('DashboardController'); ?>">
        <div class="nav-link-icon ml-2"><i data-feather="clipboard"></i></div>
        Dashboard
    </a>
    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
        <div class="nav-link-icon ml-2"><i data-feather="home"></i></div>
        Master Data
        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
            <a class="nav-link" href="<?php echo site_url('master/provinsi'); ?>">
                <div class="nav-link-icon ml-2"><i data-feather="home"></i></div>
                Provinsi
            </a>
            <a class="nav-link" href="<?php echo site_url('master/kota'); ?>">
                <div class="nav-link-icon ml-2"><i data-feather="home"></i></div>
                Kota
            </a>
            <a class="nav-link" href="<?php echo site_url('master/kecamatan'); ?>">
                <div class="nav-link-icon ml-2"><i data-feather="home"></i></div>
                Kecamatan
            </a>
            <a class="nav-link" href="<?php echo site_url('master/kelurahan'); ?>">
                <div class="nav-link-icon ml-2"><i data-feather="home"></i></div>
                Kelurahan
            </a>
        </nav>
    </div>

    <a class="nav-link " href="<?php echo site_url('lahan'); ?>">
        <div class="nav-link-icon ml-2"><i data-feather="book-open"></i></div>
        Lahan
    </a>

    <a class="nav-link " href="<?php echo site_url('urban-farming'); ?>">
        <div class="nav-link-icon ml-2"><i data-feather="archive"></i></div>
        Urban Farming
    </a>

    <a class="nav-link " href="<?php echo site_url('user'); ?>">
        <div class="nav-link-icon ml-2"><i data-feather="users"></i></div>
        User
    </a>
</div>
<div class="sidenav-footer">
    <div class="sidenav-footer-content">
        <div class="sidenav-footer-subtitle">Login Sebagai:</div>
        <div class="sidenav-footer-title">Admin</div>
    </div>
</div>