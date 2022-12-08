<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <?php if (session()->getFlashdata('data')) {
            $room =  (object)session()->getFlashdata('data'); ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    <?= $error; ?>
                </div>
            </div>
        <?php } ?>
        <div class="card col-12">
            <form action="<?= site_url('surat/keluar/upload/' . $keluar->id); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="file">File Surat Nomor <?= $keluar->nosusun; ?></label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="file" name="file" value="<?= old('file') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    .PDF
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-secondary"> Reset </button>
                    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-paper-plane"></i> Simpan </button>
                </div>
            </form>
        </div>

        <div class="section-body">
        </div>
    </section>
</div>
<?= $this->endSection(); ?>