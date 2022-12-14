<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="card col-12">
            <form action="<?= site_url('mahasiswa/insert'); ?>" method="POST" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name" value="<?= old('name'); ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="form-group">
                                <label>NIM</label>
                                <input type="text" class="form-control" name="nim" value="<?= old('nim'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= old('email'); ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="form-group">
                                <label>Prodi</label>
                                <select class="form-control" name="prodi" id="">
                                    <option value="S1 FILSAFAT" <?= old('prodi') == 'S1 FILSAFAT' ? 'selected' : ''; ?>>S1 FILSAFAT</option>
                                    <option value="MAGISTER FILSAFAT" <?= old('prodi') == 'MAGISTER FILSAFAT' ? 'selected' : ''; ?>>MAGISTER FILSAFAT</option>
                                    <option value="DOKTOR FILSAFAT" <?= old('prodi') == 'DOKTOR FILSAFAT' ? 'selected' : ''; ?>>DOKTOR FILSAFAT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="form-group">
                                <label>Angkatan</label>
                                <input type="number" class="form-control" name="angkatan" value="<?= old('angkatan'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-4">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" value="<?= old('tempat_lahir'); ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="">
                                    <option value="AKTIF" <?= old('status') == 'AKTIF' ? 'selected' : ''; ?>>AKTIF</option>
                                    <option value="TIDAK AKTIF" <?= old('status') == 'TIDAK AKTIF' ? 'selected' : ''; ?>>TIDAK AKTIF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="<?= old('alamat'); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-secondary"> Reset </button>
                    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-paper-plane"></i> Submit </button>
                </div>
            </form>
        </div>
        <div class="section-body">
        </div>
    </section>
</div>
<?= $this->endSection(); ?>