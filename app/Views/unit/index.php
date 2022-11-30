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
                <a href="<?= site_url('unit/new'); ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah Unit </a>
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
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Unit</th>
                                        <th>Kode Unit</th>
                                        <th style="width:15%">Action</th>
                                    </tr>
                                    <?php $i = 1;
                                    foreach ($unit as $row) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row->name; ?></td>
                                            <td><?= $row->kode; ?></td>
                                            <td>
                                                <a href="<?= site_url('unit/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                                                <form action="<?= site_url('unit/delete/' . $row->id); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus Unit ?')">
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