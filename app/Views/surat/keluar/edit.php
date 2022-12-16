<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="card col-12">
            <form action="<?= site_url('surat/updatekeluar/' . $keluar->id); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Fakultas</label>
                                <input type="text" class="form-control" name="fakultas" value="Filsafat" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Pejabat Pengesah</label>
                                <select class="form-control" name="pengesah" id="pengesah" required>
                                    <option selected>-Pilih Pengesah-</option>
                                    <?php foreach ($pengesah as $option) { ?>
                                        <option value="<?= $option->id; ?>" <?= $keluar->pengesah == $option->id ? 'selected' : ''; ?>><?= $option->name; ?> - <?= $option->jabatan; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Jenis Surat</label>
                                <select class="form-control" name="jenis" id="jenis" required>
                                    <option selected>-Pilih Jenis-</option>
                                    <?php foreach ($jenis as $option) { ?>
                                        <option value="<?= $option->id; ?>" <?= $keluar->jenis == $option->id ? 'selected' : ''; ?>><?= $option->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Unit Pengajuan</label>
                                <select class="form-control" name="unit" id="unit" required>
                                    <option selected>-Pilih Unit-</option>
                                    <?php foreach ($unit as $option) { ?>
                                        <option value="<?= $option->id; ?>" <?= $keluar->unit == $option->id ? 'selected' : ''; ?>><?= $option->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input type="date" class="form-control" name="tanggal" value="<?= $keluar->tanggal; ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Kode Perihal</label>
                                <select class="form-control" name="perihal" id="perihal" required>
                                    <option selected>-Pilih Perihal-</option>
                                    <?php foreach ($perihal as $option) { ?>
                                        <option value="<?= $option->id; ?>" <?= $keluar->perihal == $option->id ? 'selected' : ''; ?>><?= $option->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Kepada/Ditujukan</label>
                                <input type="text" class="form-control" name="ditujukan" value="<?= $keluar->ditujukan; ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Hal Surat</label>
                                <input type="text" class="form-control" name="halsurat" value="<?= $keluar->halsurat; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Sifat Surat</label>
                                    <input type="text" class="form-control" name="sifat" value="<?= $keluar->sifat; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Status</label>
                                    <input type="text" class="form-control" name="status" value="<?= $keluar->status; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Isi Surat</label>
                                <textarea class="form-control" name="isisurat" rows="10"><?= $keluar->isisurat; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file">File Surat</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="file" name="file" value="<?= old('file') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    .PDF
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="nourut" value="" <?= $keluar->nourut; ?>>
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