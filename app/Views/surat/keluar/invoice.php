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

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Nomor Surat</h2>
                                <div class="invoice-number"><?= $keluar->nosusun; ?></div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Dari:</strong><br>
                                        <?= $keluar->unitname; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Kepada:</strong><br>
                                        <?= $keluar->ditujukan; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Perihal:</strong><br>
                                        <?= $keluar->perihalname; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Nomor Surat:</strong><br>
                                        <?= $keluar->nosusun; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Hal:</strong><br>
                                        <?= $keluar->halsurat; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Isi Surat:</strong><br>
                                        <?= $keluar->isisurat; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Pembuat Surat:</strong><br>
                                        <?= $keluar->pembuatname; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <strong>File Surat:</strong><br>
                                    <?php if ($keluar->file && (session('id') == $keluar->pembuat || session('id') == 'admin')) : ?>
                                        <iframe src="<?= base_url('files/suratkeluar/' . $keluar->file); ?>" width="100%" height="500px">
                                        </iframe>
                                    <?php else : ?>
                                        <a href="<?= site_url('surat/keluar/upload/' . $keluar->id); ?>" class="btn btn-primary" title="Upload Surat"> <i class="fa fa-upload"></i> Upload Surat </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>