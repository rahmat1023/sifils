<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div>
                <h1><?= $title; ?></h1>
            </div>
            <div class="section-header-breadcrumb">
                <a href="<?= site_url('surat/masuk/add'); ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah Surat Masuk </a>
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
        <?php if (session()->getFlashdata('deleted')) : ?>
            <div class="alert alert-warning alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    <?= session()->getFlashdata('deleted'); ?>
                </div>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('status')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    <?= session()->getFlashdata('status'); ?>
                </div>
            </div>
        <?php endif ?>
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

        <div class="section-body">
            <div class="col-12 p-0">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Asal</th>
                                        <th>Perihal-Isi</th>
                                        <th>Ditujukan</th>
                                        <th>Penerima</th>
                                        <th>Tanggal</th>
                                        <th>Pembuat</th>
                                        <th style="width:15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($masuk as $row) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row->nosusun; ?></td>
                                            <td><?= $row->asal; ?></td>
                                            <td><?= $row->halsurat . '-' . $row->isisurat; ?></td>
                                            <td><?= $row->ditujukan; ?></td>
                                            <td><?= $row->penerima; ?></td>
                                            <td><?= $row->tanggal; ?></td>
                                            <td><?= $row->pembuat; ?></td>
                                            <td>
                                                <?php if (session('role') == 'admin' || session('id') == $row->pembuat) : ?>
                                                    <a href="<?= site_url('surat/masuk/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                                                    <a href="<?= site_url('surat/masuk/delete/' . $row->id); ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Hapus Surat ?')"><i class="fa fa-trash"></i></a>
                                                    <?php if ($row->file) : ?>
                                                        <a href="<?= base_url('files/suratmasuk/' . $row->file); ?>" class="btn btn-success" title="Lihat Surat"><i class="fa fa-eye"></i></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>