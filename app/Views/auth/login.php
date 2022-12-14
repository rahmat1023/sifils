<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login | SiFilsafat</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/assets/css/components.css">
    <link rel="shortcut icon" href="<?= base_url() ?>/favicon.ico" />

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="login-brand">
                    SiFilsafat v2
                    <!-- <img src="<?= base_url() ?>/stisla/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="d-inline">Agenda Hari Ini</h4>
                            </div>
                            <div class="card-body">
                                <?php if ($booking) :; ?>
                                    <ul class="list-unstyled list-unstyled-border">
                                        <?php foreach ($booking as $row) {
                                            $start = date('H:i', strtotime($row->start));
                                            $end = date('H:i', strtotime($row->end));
                                            $now = date('H:i', time());
                                            if ($now > $end) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }

                                        ?>
                                            <li class="media">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" <?= $checked; ?>>
                                                    <label class="custom-control-label" for="cbx-1"></label>
                                                </div>
                                                <div class="media-body">
                                                    <div class="badge badge-pill badge-primary mb-1 float-right"><?= $start . ' ' . $end; ?></div>
                                                    <h6 class="media-title"><a href="#"><?= $row->name; ?></a></h6>
                                                    <div class="text-small text-muted">
                                                        <?= $row->ruangname; ?>
                                                        <div class="bullet"></div>
                                                        <span class="text-primary">PIC : <?= $row->pic; ?></span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php else : ?>
                                    <div class="text-center">
                                        Belum ada agenda untuk hari ini
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer">
                                <a href="<?= site_url('confirmguestbooking'); ?>" class="btn btn-primary float-right ml-1">Booking Ruang</a>
                                <a href="<?= site_url('availability'); ?>" class="btn btn-primary float-right ml-1">Cek Ketersediaan Ruang</a>
                                <a href="<?= site_url('cekstatus'); ?>" class="btn btn-primary float-right">Cek Status Booking</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login ke Sistem</h4>
                            </div>

                            <div class="card-body">
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
                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-primary alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                                <span>×</span>
                                            </button>
                                            <?= session()->getFlashdata('success'); ?>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <form method="POST" action="<?= site_url('login'); ?>" class="needs-validation" novalidate="">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Buat Akun Mahasiswa ? <a href="<?= site_url('inputnim'); ?>">Klik Disini</a>
                        </div>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; 2022-<?= date('Y'); ?> | Rahmat Alfianto @ IT Filsafat UGM
                </div>
            </div>
        </section>
    </div>


    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/stisla/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/stisla/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/stisla/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/stisla/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/stisla/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>