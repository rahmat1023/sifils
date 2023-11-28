<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="section-body">
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
            <div class="card">
                <div class="card-body">
                    <div class="col-12 col-md-6">
                        <div class="section-title mt-0">Reset Nomor Surat (No surat terakhir : <?= $last; ?>)</div>
                        <form action="<?= site_url('resetkeluar'); ?>" method="POST" autocomplete="off">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Reset Mulai Nomor</span>
                                    </div>
                                    <input type="number" class="form-control" value="1" name="number" aria-label="" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Reset Surat</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>