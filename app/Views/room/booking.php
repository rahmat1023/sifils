<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="section-body">
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
                <form action="<?= site_url('room/insert'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12 col-lg-8">
                                <label>Nama Kegiatan</label>
                                <input type="text" class="form-control" name="name" value="<?= old('name') ?>" required autofocus>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="file">Proposal</label>
                                    <!-- <input type="text" class="form-control" name="proposal" value="<?= old('proposal') ?>" readonly> -->
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="file" name="proposal" value="<?= old('proposal') ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                .PDF
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-lg-4">
                                <label>PIC Kegiatan</label>
                                <input type="text" class="form-control" name="pic" value="<?= old('pic'); ?>" required>
                            </div>

                            <div class="form-group col-12 col-lg-4">
                                <label>No Handphone</label>
                                <input type="number" class="form-control" name="phone" value="<?= old('phone'); ?>" required>
                            </div>

                            <div class="form-group col-12 col-lg-4">
                                <label>Jumlah Peserta</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="peserta" value="<?= old('peserta') ?>">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            Peserta
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="form-group col-12 col-lg-4">
                                <label>Nama Unit</label>
                                <select class="form-control" name="unit" id="unit" required>
                                    <option selected>-Pilih Unit-</option>
                                    <?php foreach ($unit as $option) { ?>
                                        <option value="<?= $option->id; ?>" <?= old('unit') == $option->id ? 'selected' : ''; ?>><?= $option->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label>Jenis Acara</label>
                                <select class="form-control" name="acara" id="">
                                    <option value="Internal Fakultas" <?= old('acara') == 'Internal Fakultas' ? 'selected' : ''; ?>>Internal Fakultas</option>
                                    <option value="Internal UGM" <?= old('acara') == 'Internal UGM' ? 'selected' : ''; ?>>Internal UGM</option>
                                    <option value="Luar UGM" <?= old('acara') == 'Luar UGM' ? 'selected' : ''; ?>>Luar UGM</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="ket">Parkir</label>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="motor" value="<?= old('motor'); ?>">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        Motor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="mobil" value="<?= old('mobil'); ?>">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        Mobil
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-lg-4">
                                <label>Ruang</label>
                                <select class="form-control select2" name="ruang" id="ruang" required>
                                    <option selected>-Pilih Ruang-</option>
                                    <?php foreach ($ruang as $option) { ?>
                                        <option value="<?= $option->id; ?>" <?= old('ruang') == $option->id ? 'selected' : ''; ?>><?= $option->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="<?= old('tanggal'); ?>" required>
                            </div>
                            <div class="form-group col-6 col-lg-2">
                                <label>Waktu Mulai</label>
                                <input type="time" class="form-control" name="start" value="<?= old('start'); ?>" required>
                            </div>
                            <div class="form-group col-6 col-lg-2">
                                <label>Waktu Selesai</label>
                                <input type="time" class="form-control" name="end" value="<?= old('end'); ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alat">Alat</label>
                                    <textarea name="alat" id="alat" id="alat" class="form-control" placeholder="Daftar alat yang diperlukan" rows="8"> <?= old('alat'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ket">Catatan</label>
                                    <textarea class="form-control" type="text" name="ket" id="ket" placeholder="Catatan dari Fakultas" rows="8"> <?= old('ket'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="copy" value="1">
                            <label class="custom-control-label" for="customCheck1">Copy <small style="color:red"> (Centang jika ingin copy booking)</small></label>
                        </div>
                    </div>
                    <input type="hidden" class="form-control " id="pembuat" value="<?= session('id'); ?>" name="createdBy" maxlength="128">

                    <div class="card-footer">
                        <button type="reset" class="btn btn-secondary"> Reset </button>
                        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-paper-plane"></i> Simpan </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
<?= $this->endSection(); ?>