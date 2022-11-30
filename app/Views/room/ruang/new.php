<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="card col-12 col-lg-6">
            <div class="card-header">
                <h4>Tambah Ruang Baru</h4>
            </div>
            <form action="<?= site_url('ruang'); ?>" method="POST" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Ruang</label>
                        <input type="text" class="form-control" name="name" required autofocus>
                    </div>
                    <div class="form-group">
                        <label>Gedung</label>
                        <input type="text" class="form-control" name="gedung" required>
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