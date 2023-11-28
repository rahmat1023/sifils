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
                                <h2>Nomor Keputusan</h2>
                                <div class="invoice-number"><span id="nosusun"><?= $keputusan->nosusun; ?> </span> <button class="btn btn-sm btn-outline-secondary" onclick="CopyToClipboard('nosusun')" id="toastr-1"> <i class="far fa-copy"></i>Copy</button></div>
                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Nomor Surat:</strong><br>
                                        <?= $keputusan->nosusun; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Isi Keputusan:</strong><br>
                                        <?= $keputusan->isi; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Pengesah Keputusan:</strong><br>
                                        <?= $keputusan->pengesahname; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Unit Pengolah:</strong><br>
                                        <?= $keputusan->unitname; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Pembuat Surat:</strong><br>
                                        <?= $keputusan->pembuatname; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <strong>File Surat:</strong><br>
                                    <?php if ($keputusan->file && (session('id') == $keputusan->pembuat || session('role') == 'admin')) : ?>
                                        <iframe src="<?= base_url('files/keputusan/' . $keputusan->file); ?>" width="100%" height="500px">
                                        </iframe>
                                    <?php else : ?>
                                        <a href="<?= site_url('keputusan/upload/' . $keputusan->id); ?>" class="btn btn-primary" title="Upload Surat"> <i class="fa fa-upload"></i> Upload Surat </a>
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