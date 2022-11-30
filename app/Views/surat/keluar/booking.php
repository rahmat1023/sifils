<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
            <div class="section-header-breadcrumb">
                <a href="<?= site_url('surat/keluar/add'); ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah Surat Keluar </a>
            </div>
        </div>
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
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <form action="<?= site_url('surat/insertbooking'); ?>" method="POST" autocomplete="off">
                        <div class="card card-info">
                            <div class="card-header">
                                <h4>Tambah Booking</h4>
                            </div>
                            <div class="card-body">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-3 col-lg-2">
                                        <div class="form-group">
                                            <label>Jumlah Booking</label>
                                            <input type="number" class="form-control" name="jumlah" value="1" required>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Tanggal Surat</label>
                                            <input type="date" class="form-control" name="tanggal" required>
                                        </div>
                                    </div>
                                    <div class="col-3 col-lg-2">
                                        <div class="form-group">
                                            <label>Aksi</label>
                                            <button type="submit" class="btn btn-primary form-control"> <i class="fa fa-paper-plane"></i> Submit </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h4>Daftar Booking</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id='table-1'>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Aksi</th>
                                            <th>Nomor Urut</th>
                                            <th>Tanggal Surat</th>
                                            <th>Pembuat</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php $i = 1;
                                        foreach ($booking as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td>
                                                    <a href="<?= site_url('surat/keluar/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                                                    <a href="<?= site_url('surat/keluar/delete/' . $row->id); ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Hapus User ?')"><i class="fa fa-trash"></i></a>
                                                </td>
                                                <td><?= $row->nourut; ?></td>
                                                <td><?= $row->tanggal; ?></td>
                                                <td><?= $row->pembuatname; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>