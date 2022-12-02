<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    <?= session()->getFlashdata('success'); ?>
                </div>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            </div>
        <?php endif ?>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Agenda</h4>
                            </div>
                            <div class="card-body">
                                <?= $agenda; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (session('surat') == 1) : ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Surat Masuk</h4>
                                </div>
                                <div class="card-body">
                                    <?= $masuk; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Surat Keluar</h4>
                            </div>
                            <div class="card-body">
                                <?= $keluar; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (session('role') == 'admin' || session('role') == 'manager' || session('role') == 'pimpinan') : ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Booking Baru</h4>
                                </div>
                                <div class="card-body">
                                    <?= $booking; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 mb-4 p-0">
                <div class="hero bg-primary text-white">
                    <div class="hero-inner">
                        <h2>Hai, <?= session('name'); ?>!</h2>
                        <p class="lead">Selamat datang di siFilsafat 2.0. Mau apa Anda hari ini ?</p>
                        <div class="mt-4">
                            <a href="<?= site_url('changepass'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-key"></i>Ganti Password</a>
                            <a href="<?= site_url('room/index'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-calendar"></i>Lihat Agenda</a>
                            <?php if (session('role') == 'admin' || session('role') == 'manager' || session('role') == 'employee' || session('role') == 'pimpinan') : ?>
                                <a href="<?= site_url('surat/keluar/add'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-envelope"></i>Ambil Nomor Surat</a>
                                <a href="<?= site_url('room/booking'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-th"></i>Booking Ruang</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ((session('role') == 'admin' || session('role') == 'manager' || session('role') == 'pimpinan') && (count($roombooking) > 0 || count($roomverified) > 0)) : ?>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Booking Baru</h4>
                    </div>
                    <div class="card-body">
                        <?= $this->include('room/bookingnew'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>