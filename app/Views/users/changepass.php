<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
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
        <div class="card col-12 col-lg-6">
            <div class="card-header">
                <h4>Ganti Password</h4>
            </div>
            <form action="<?= site_url('updatepass/' . session('id')); ?>" method="post" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" name="newpassword">
                    </div>
                    <div class="form-group">
                        <label>Ulangi Password Baru</label>
                        <input type="password" class="form-control" name="confpassword">
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