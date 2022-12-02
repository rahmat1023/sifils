<?php
$uri = current_url(true);
$totaluri = $uri->getTotalSegments();
?>
<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li <?= $uri->getSegment(1) == null ? 'class="active"' : ''; ?>>
        <a href="<?= site_url(); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
    </li>
    <li class="menu-header">Menu</li>
    <?php if (session('role') == 'admin' || session('role') == 'manager'  || session('role') == 'pimpinan' || session('role') == 'employee') : ?>
        <li class="nav-item dropdown <?= $uri->getSegment(1) == 'surat' && $uri->getSegment(2) == 'keluar' ? 'active' : ''; ?>">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-envelope"></i> <span>Surat Keluar</span></a>
            <ul class="dropdown-menu">
                <li class="<?= $uri->getSegment(1) == 'surat' && $uri->getSegment(2) == 'keluar' && $uri->getSegment(3) == ''  ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('surat/keluar'); ?>">Daftar Surat</a>
                </li>
                <li class="<?= $uri->getSegment(1) == 'surat' && $uri->getSegment(2) == 'keluar' && $uri->getSegment(3) == 'add' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('surat/keluar/add'); ?>">Ambil Nomor Surat</a>
                </li>
                <li class="<?= $uri->getSegment(1) == 'surat' && $uri->getSegment(2) == 'keluar' && $uri->getSegment(3) == 'booking' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('surat/keluar/booking'); ?>">Booking Surat</a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
    <?php if (session('surat') == 1) : ?>
        <li class="nav-item dropdown <?= $uri->getSegment(1) == 'surat' && $uri->getSegment(2) == 'masuk'  ? 'active' : ''; ?>">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-envelope"></i> <span>Surat Masuk</span></a>
            <ul class="dropdown-menu">
                <li class="<?= $uri->getSegment(1) == 'surat' && $uri->getSegment(2) == 'masuk' && $uri->getSegment(3) == ''  ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('surat/masuk'); ?>">Daftar Surat</a>
                </li>
                <li class="<?= $uri->getSegment(1) == 'surat' && $uri->getSegment(2) == 'masuk' && $uri->getSegment(3) == 'add' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('surat/masuk/add'); ?>">Tambah Surat</a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
    <li class="nav-item dropdown <?= $uri->getSegment(1) == 'room' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Peminjaman Ruang</span></a>
        <ul class="dropdown-menu">
            <li class="<?= $uri->getSegment(1) == 'room' && $uri->getSegment(2) == 'index' ? 'active' : ''; ?>">
                <a class="nav-link " href="<?= site_url('room/index'); ?>">Agenda</a>
            </li>
            <li class="<?= $uri->getSegment(1) == 'room' && $uri->getSegment(2) == 'booking' ? 'active' : ''; ?>">
                <a class="nav-link " href="<?= site_url('room/booking'); ?>">Booking Ruang</a>
            </li>
            <li class="<?= $uri->getSegment(1) == 'room' && $uri->getSegment(2) == 'bookinglist' ? 'active' : ''; ?>">
                <a class="nav-link " href="<?= site_url('room/bookinglist'); ?>">Daftar Peminjaman</a>
            </li>
        </ul>
    </li>
    <?php if (session('role') == 'admin') { ?>
        <li class="menu-header">Panel Admin</li>

        <li class="nav-item dropdown <?= ($uri->getSegment(1) == 'jenissurat' || $uri->getSegment(1) == 'pengesahsurat' || $uri->getSegment(1) == 'perihalsurat') ? 'active' : ''; ?>">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-envelope"></i> <span>Surat</span></a>
            <ul class="dropdown-menu">
                <li class="<?= $uri->getSegment(1) == 'jenissurat' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('jenissurat'); ?>">Jenis</a>
                </li>
                <li class="<?= $uri->getSegment(1) == 'perihalsurat' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('perihalsurat'); ?>">Perihal</a>
                </li>
                <li class="<?= $uri->getSegment(1) == 'pengesahsurat' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= site_url('pengesahsurat'); ?>">Pengesah</a>
                </li>
            </ul>
        </li>
        <li <?= $uri->getSegment(1) == 'ruang'   ?  'class="active"' : ''; ?>>
            <a href="<?= site_url('ruang'); ?>" class="nav-link"><i class="fa fa-building"></i> <span>Daftar Ruang</span></a>
        </li>
        <li <?= $uri->getSegment(1) == 'unit' ? 'class="active"' : ''; ?>>
            <a href="<?= site_url('unit'); ?>" class="nav-link"><i class="fa fa-list-alt"></i> <span>Daftar Unit</span></a>
        </li>
        <li <?= $uri->getSegment(1) == 'users' ? 'class="active"' : ''; ?>>
            <a href="<?= site_url('users'); ?>" class="nav-link"><i class="fa fa-users"></i> <span>Daftar User</span></a>
        </li>
    <?php } ?>

</ul>