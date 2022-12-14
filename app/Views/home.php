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

            <div class="col-12 mb-4 p-0">
                <div class="hero bg-primary text-white">
                    <div class="hero-inner">
                        <h2>Hai, <?= session('name'); ?>!</h2>
                        <p class="lead">Selamat datang di siFilsafat 2.0. Mau apa Anda hari ini ?</p>
                        <div class="mt-4">
                            <a href="<?= site_url('changepass'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-key"></i>Ganti Password</a>
                            <?php if (session('roleid') < 6) : ?>
                                <a href="<?= site_url('room/index'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-calendar"></i>Lihat Agenda</a>
                            <?php endif;
                            if (session('roleid') < 5) : ?>
                                <a href="<?= site_url('surat/keluar/add'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-envelope"></i>Ambil Nomor Surat</a>
                            <?php endif;
                            if (session('role') != 5) : ?>
                                <a href="<?= site_url('room/booking'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-th"></i>Booking Ruang</a>
                            <?php endif;
                            if (session('roleid')  == 6) : ?>
                                <a href="<?= site_url('availability'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-check-double"></i>Cek Ketersediaan Ruang</a>
                                <a href="<?= site_url('room/bookinglist'); ?>" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-list"></i>Booking Saya</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
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
                <?php endif;
                if (session('roleid') < 5) : ?>
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
                <?php endif;
                if (session('role') == 'admin' || session('role') == 'manager' || session('role') == 'pimpinan') : ?>
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
            <?php if ((session('role') == 'admin' || session('role') == 'manager' || session('role') == 'pimpinan') && (count($roombooking) > 0 || count($roomverified) > 0)) : ?>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Booking Baru</h4>
                    </div>
                    <div class="card-body">
                        <?= $this->include('room/bookingnew'); ?>
                    </div>
                </div>
            <?php endif;
            if ($suratkeluar) : ?>
                <div class="col-12 p-0">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Surat yang belum Anda upload</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id='table-2'>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor Susun</th>
                                            <th>Pengesah</th>
                                            <th>Unit Pengajuan</th>
                                            <th>Jenis, Hal, Isi Surat</th>
                                            <th>Ditujukan</th>
                                            <th>Tanggal Surat</th>
                                            <th>Pembuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php $i = 1;
                                        foreach ($suratkeluar as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row->nosusun; ?></td>
                                                <td><?= $row->pengesahname; ?></td>
                                                <td><?= $row->unitname; ?></td>
                                                <td><?= $row->jenisname . ' - <br>' . $row->halsurat . ' - <br> <p style="color:Blue">' . $row->isisurat; ?></p>
                                                </td>
                                                <td><?= $row->ditujukan; ?></td>
                                                <td><?= $row->tanggal; ?></td>
                                                <td><?= $row->pembuatname; ?></td>
                                                <td>
                                                    <?php if (session('role') == 'admin' || session('id') == $row->pembuat || !$row->file) : ?>
                                                        <a href="<?= site_url('surat/keluar/upload/' . $row->id); ?>" class="btn btn-info" title="Upload"> <i class="fa fa-upload"></i> </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>