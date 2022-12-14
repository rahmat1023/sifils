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
                                <form method="POST" action="<?= site_url('inputnim'); ?>" class="needs-validation" novalidate="">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="nim">NIM Lengkap <small>(XX/XXXXXX/FI/XXXXX)</small> </label>
                                        <input id="nim" type="text" class="form-control" name="nim" tabindex="1" value="<?= old('nim'); ?>" placeholder="Format : XX/XXXXXX/FI/XXXXX" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your NIM
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email UGM <small>(xxxx@mail.ugm.ac.id)</small> </label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="2" value="<?= old('email'); ?>" placeholder="Format : xxxx@mail.ugm.ac.id" required>
                                        <div class="invalid-feedback">
                                            Please fill in your Email
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Lanjut
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Sudah Punya Akun ? <a href="<?= site_url('login'); ?>">Login Disini</a>
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