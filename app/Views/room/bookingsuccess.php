<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Booking Success | SiFilsafat</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/assets/css/components.css">
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
                    Booking Berhasil !
                </div>
                <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Detail Booking</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    Kode Booking Anda
                                </div>
                                <div class="float-right mr-2">
                                    <span class="badge badge-primary"><?= session()->getFlashdata('token') ?></span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    Simpan Kode Booking anda untuk melacak status peminjaman ruang.
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= site_url() ?>" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Kembali</a>

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">

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