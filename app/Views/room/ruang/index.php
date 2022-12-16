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
                <a href="<?= site_url('ruang/new'); ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah Ruang </a>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ruang</th>
                                        <th>Gedung</th>
                                        <th>Ukuran</th>
                                        <th>Kapasitas</th>
                                        <th style="width:15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $i = 1;
                                    foreach ($ruang as $row) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row->name; ?></td>
                                            <td><?= $row->gedung; ?></td>
                                            <td><?= $row->p; ?>m x <?= $row->l; ?>m x <?= $row->t; ?>m </td>
                                            <td><?= $row->kapasitas; ?></td>
                                            <td>
                                                <a href="<?= site_url('ruang/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                                                <form action="<?= site_url('ruang/delete/' . $row->id); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus Ruang ?')">
                                                    <?= csrf_field(); ?>
                                                    <button class="btn btn-danger" title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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