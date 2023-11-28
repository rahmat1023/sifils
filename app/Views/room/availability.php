<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Cek Ruang | SiFilsafat</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/select2/dist/css/select2.css">
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
                    <a href="<?= site_url() ?>"> SiFilsafat </a>
                    <!-- <img src="<?= base_url() ?>/stisla/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <a href="<?= site_url(); ?>" class="btn btn-primary btn-lg"> <i class="fa fa-arrow-left"></i> Kembali</a>
                                <div class="p-2"></div>
                                <h4><?= $title ?></h4>
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
                                    <div class="alert alert-success alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                                <span>×</span>
                                            </button>
                                            <?= session()->getFlashdata('success'); ?>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <form method="POST" action="<?= site_url('checkroom'); ?>" class="needs-validation" novalidate="">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Ruang</label>
                                            <select class="form-control select2" name="ruang" id="ruang" required>
                                                <option selected>-Pilih Ruang-</option>
                                                <?php foreach ($ruang as $option) { ?>
                                                    <option value="<?= $option->id; ?>" <?= old('ruang') == $option->id ? 'selected' : ''; ?>><?= $option->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-6 col-lg-4">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= old('tanggal'); ?>" required>
                                        </div>
                                        <div class="form-group col-3 col-lg-2">
                                            <label>Waktu Mulai</label>
                                            <input type="time" class="form-control" name="start" value="<?= old('start'); ?>" required>
                                        </div>
                                        <div class="form-group col-3 col-lg-2">
                                            <label>Waktu Selesai</label>
                                            <input type="time" class="form-control" name="end" value="<?= old('end'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-3 float-right">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            <i class="fa-solid fa-magnifying-glass"></i> Cari
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
    <script src="<?= base_url() ?>/stisla/node_modules/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url() ?>/stisla/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/stisla/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/stisla/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>