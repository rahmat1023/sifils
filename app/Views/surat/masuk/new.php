<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="card col-12">
            <form action="<?= site_url('surat/insertmasuk'); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xl-4">
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <input type="text" class="form-control" name="nosusun" required>
                            </div>
                        </div>
                        <div class="col-12 col-xl-2">
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label>Asal Surat</label>
                                <input type="text" class="form-control" name="asal" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label>Kepada/Ditujukan</label>
                                <input type="text" class="form-control" name="ditujukan" required>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label>Perihal Surat</label>
                                <input type="text" class="form-control" name="halsurat" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Penerima Surat</label>
                                    <input type="text" class="form-control" name="penerima" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="form-group">
                                        <label for="file">File Surat</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="file" name="file" value="<?= old('file') ?>" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    .PDF
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label>Isi Surat</label>
                                <textarea class="form-control" name="isisurat" rows="10"></textarea>
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