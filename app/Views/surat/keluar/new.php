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
        <div class="card col-12">
            <form action="<?= site_url('surat/insertkeluar'); ?>" method="POST">
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
                                    <option value="" selected>-Pilih Pengesah-</option>
                                    <?php foreach ($pengesah as $option) { ?>
                                        <option value="<?= $option->id; ?>"><?= $option->name; ?> - <?= $option->jabatan; ?></option>
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
                                    <option value="" selected>-Pilih Jenis-</option>
                                    <?php foreach ($jenis as $option) { ?>
                                        <option value="<?= $option->id; ?>"><?= $option->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Unit Pengajuan</label>
                                <select class="form-control" name="unit" id="unit" required>
                                    <option value="" selected>-Pilih Unit-</option>
                                    <?php foreach ($unit as $option) { ?>
                                        <option value="<?= $option->id; ?>"><?= $option->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input onkeydown="return false" type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Kode Perihal</label>
                                <select class="form-control" name="perihal" id="perihal" required>
                                    <option value="" selected>-Pilih Perihal-</option>
                                    <?php foreach ($perihal as $option) { ?>
                                        <option value="<?= $option->id; ?>"><?= $option->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Kepada/Ditujukan</label>
                                <input type="text" class="form-control" name="ditujukan" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Hal Surat</label>
                                <input type="text" class="form-control" name="halsurat" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Sifat Surat</label>
                                    <select class="form-control" name="sifat" id="sifat" required>
                                        <option value="Biasa" selected>Biasa</option>
                                        <option value="Rahasia">Rahasia</option>
                                        <option value="Sangat Rahasia">Sangat Rahasia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Status</label>
                                    <input type="text" class="form-control" name="status" value="Used" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Isi Surat</label>
                                <textarea class="form-control" name="isisurat" rows="10"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="pembuat" value="<?= session('id'); ?>">
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