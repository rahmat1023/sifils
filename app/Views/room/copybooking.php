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
                    <?= $room->error; ?>
                </div>
            </div>
        <?php } ?>
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
        <div class="card col-12">
            <form action="<?= site_url('room/insert'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-8">
                            <label>Nama Kegiatan</label>
                            <input type="text" class="form-control" name="name" value="<?= $room->name; ?>" required autofocus>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="file">Proposal</label>
                                <input type="text" class="form-control" name="proposal" value="<?= $room->proposal; ?>" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label>PIC Kegiatan</label>
                            <input type="text" class="form-control" name="pic" value="<?= $room->pic; ?>" required>
                        </div>
                        <div class="form-group col-4">
                            <label>No Handphone</label>
                            <input type="number" class="form-control" name="phone" value="<?= $room->phone; ?>" required>
                        </div>
                        <div class="form-group col-4">
                            <label>Jumlah Peserta</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="peserta" value="<?= $room->peserta; ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        Peserta
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label>Nama Unit</label>
                            <select class="form-control" name="unit" id="unit">
                                <option selected>-Pilih Unit-</option>
                                <?php foreach ($unit as $option) { ?>
                                    <option value="<?= $option->id; ?>" <?= $option->id == $room->unit ? 'selected' : ''; ?>><?= $option->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Jenis Acara</label>
                            <select class="form-control" name="acara" id="">
                                <option value="Internal Fakultas" <?= $room->acara == 'Internal Fakultas' ? 'selected' : ''; ?>>Internal Fakultas</option>
                                <option value="Internal UGM" <?= $room->acara == 'Internal UGM' ? 'selected' : ''; ?>>Internal UGM</option>
                                <option value="Luar UGM" <?= $room->acara == 'Luar UGM' ? 'selected' : ''; ?>>Luar UGM</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ket">Parkir</label>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="motor" value="<?= $room->motor; ?>">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    Motor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="mobil" value="<?= $room->mobil; ?>">
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
                        <div class="form-group col-4">
                            <label>Ruang</label>
                            <select class="form-control select2" name="ruang" id="ruang">
                                <option selected>-Pilih Ruang-</option>
                                <?php foreach ($ruang as $option) { ?>
                                    <option value="<?= $option->id; ?>" <?= $option->id == $room->ruang ? 'selected' : ''; ?>><?= $option->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d', strtotime("$room->start")); ?>" required>
                        </div>
                        <div class="form-group col-2">
                            <label>Waktu Mulai</label>
                            <input type="time" class="form-control" name="start" value="<?= date('H:i', strtotime("$room->start")); ?>" required>
                        </div>
                        <div class="form-group col-2">
                            <label>Waktu Selesai</label>
                            <input type="time" class="form-control" name="end" value="<?= date('H:i', strtotime("$room->end")); ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alat">Alat</label>
                                <textarea name="alat" id="alat" class="form-control" placeholder="Daftar alat yang diperlukan" rows="8"><?= $room->alat; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ket">Catatan</label>
                                <textarea class="form-control" type="text" name="ket" id="ket" placeholder="Catatan dari Fakultas" rows="8"> <?= $room->ket; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="copy" value="1">
                        <label class="custom-control-label" for="customCheck1">Copy <small style="color:red"> (Centang jika ingin menginput ruang/hari/jam lain dengan acara yang sama)</small></label>
                    </div>
                </div>
                <input type="hidden" class="form-control" id="pembuat" value="<?= session('id') ? session('id') : '0'; ?>" name="createdBy" maxlength="128">
                <input type="hidden" class="form-control" id="token" value="<?= $room->token; ?>" name="token">
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