<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register | SiFilsafat</title>

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
                    <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Registrasi Akun Mahasiswa</h4>
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
                                <form method="POST" action="<?= site_url('register'); ?>">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="nim">NIM Lengkap</label>
                                        <input id="nim" type="text" class="form-control" tabindex="1" value="<?= $nim; ?>" readonly>
                                        <input type="hidden" name="sid" value="<?= $id; ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input id="name" type="text" class="form-control" name="name" tabindex="1" value="<?= $name; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="prodi">Program Studi</label>
                                            <input id="prodi" type="text" class="form-control" tabindex="1" value="<?= $prodi; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="angkatan">Angkatan</label>
                                            <input id="angkatan" type="number" class="form-control" tabindex="1" value="<?= $angkatan; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="email">Email UGM</label>
                                            <input id="email" type="email" class="form-control" name="email" tabindex="1" value="<?= $email ?>" placeholder="@mail.ugm.ac.id" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="phone">Nomor Handphone</label>
                                            <input id="phone" type="number" class="form-control" name="phone" tabindex="2" value="<?= old('phone'); ?>" autofocus required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="password">Password Baru</label>
                                            <input id="password" type="password" class="form-control" name="password" tabindex="3" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="passconf">Konfirmasi Password</label>
                                            <input id="passconf" type="password" class="form-control" name="passconf" tabindex="4" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="5">
                                            Lanjut
                                        </button>
                                    </div>
                                </form>
                            </div>
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