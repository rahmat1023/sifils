<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Cek Booking | SiFilsafat</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/select2/dist/css/select2.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/css/step.css">
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
                    <a href="<?= site_url() ?>"> SiFilsafat v2 </a>
                    <!-- <img src="<?= base_url() ?>/stisla/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> -->
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-3">
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
                                <form method="POST" action="<?= site_url('checkstatus'); ?>" class="needs-validation" novalidate="">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Token</label>
                                            <input type="text" class="form-control" name="token" value="<?= old('token'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-lg btn-round btn-primary">
                                            Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php if ($room) {
                        ?>
                            <div class="class card card-primary">
                                <div class="card-header">
                                    <h4>Status Booking <?= $room[0]->name; ?> (PIC : <?= $room[0]->pic; ?>) </h4>
                                </div>
                                <div class="card-body">
                                    <div id="accordion">
                                        <?php $i = 0;
                                        $tarif = 0;
                                        foreach ($room as $data) {
                                            $i++;
                                            if ($data->accepted_at == NULL) {
                                                $accepted = 'secondary';
                                                $accepted_icon = 'spinner';
                                            } elseif ($data->status == 'diterima') {
                                                $accepted = 'primary';
                                                $accepted_icon = 'check';
                                            } else {
                                                $accepted = 'danger';
                                                $accepted_icon = 'times';
                                            }
                                            if ($data->verified_at == NULL) $verified = 'secondary';
                                            elseif ($data->status == 'ditolak') $verified = 'danger';
                                            else $verified = 'primary'; ?>
                                            <div class="accordion">
                                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-<?= $i ?>" aria-expanded="<?= $i == 1 ? 'true' : 'false' ?>">
                                                    <h4><?= $data->ruangname; ?> | <?= date('d-m-Y', strtotime($data->start)); ?>, <?= date('H:i', strtotime($data->start)) . '-' . date('H:i', strtotime($data->end)); ?></h4>
                                                </div>
                                                <div class="accordion-body collapse <?= $i == 1 ? 'show' : '' ?>" id="panel-body-<?= $i ?>" data-parent="#accordion">
                                                    <div class="activities">
                                                        <div class="activity">
                                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                                <i class="fas fa-check"></i>
                                                            </div>
                                                            <div class="activity-detail">
                                                                <div class="mb-2">
                                                                    <span class="text-job"><?= $data->created_at; ?></span>
                                                                    <span class="bullet"></span>
                                                                    <a class="text-job" href="#">Diajukan oleh <?= $data->createdBy == 0 ? $data->pic : $data->creator; ?></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="activity">
                                                            <div class="activity-icon bg-<?= $verified; ?> text-white shadow-<?= $verified; ?>">
                                                                <i class="fas fa-<?php if ($data->verified_at) {
                                                                                        if ($data->status != 'ditolak') {
                                                                                            echo 'check';
                                                                                        } else {
                                                                                            echo 'times';
                                                                                        }
                                                                                    } else {
                                                                                        echo 'spinner';
                                                                                    } ?>"></i>
                                                            </div>
                                                            <div class="activity-detail">
                                                                <div class="mb-2">
                                                                    <span class="text-job"><?= $data->verified_at; ?></span>
                                                                    <span class="bullet"></span>
                                                                    <a class="text-job" href="#">Verifikasi Oleh Wakil Dekan II</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="activity">
                                                            <div class="activity-icon bg-<?= $accepted; ?> text-white shadow-<?= $accepted; ?>">
                                                                <i class="fas fa-<?= $accepted_icon ?>"></i>
                                                            </div>
                                                            <div class="activity-detail">
                                                                <div class="mb-2">
                                                                    <span class="text-job"><?= $data->accepted_at; ?></span>
                                                                    <span class="bullet"></span>
                                                                    <a class="text-job" href="#">Acc oleh Kepala Kantor</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="activity">
                                                            <div class="activity-icon bg-<?= $accepted; ?> text-white shadow-<?= $accepted; ?>">
                                                                <i class="fas fa-<?= $accepted_icon ?>"></i>
                                                            </div>
                                                            <div class="activity-detail">
                                                                <div class="mb-2">
                                                                    <span class="text-job"><?= $data->accepted_at; ?></span>
                                                                    <span class="bullet"></span>
                                                                    <?php if ($data->accepted_at) : ?>
                                                                        <a class="text-job" href="#">Acara <?= $data->status == 'diterima' ? 'Diterima' : 'Ditolak'; ?></a>
                                                                    <?php else : ?>
                                                                        <a class="text-job" href="#">Acara Terpublish/Ditolak</a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($data->biaya > 0) {
                                                        $tarif += $data->biaya;
                                                        helper('number'); ?>
                                                        <div class="card-footer">Tarif : <span class="badge badge-info"><?= number_to_currency($data->biaya, 'IDR', 'id_ID', 0); ?></span></div>
                                                    <?php } ?>
                                                    <?php if ($data->reject) : ?>
                                                        <div class="card-footer">Alasan ditolak : <?= $data->reject; ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($data->balasan) : ?>
                                                        <div class="card-footer"><a href="<?= base_url('files/balasan/' . $data->balasan); ?>" class="btn btn-primary">Lihat Surat Balasan</a></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?= $tarif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php }; ?>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; 2022 | Rahmat A
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