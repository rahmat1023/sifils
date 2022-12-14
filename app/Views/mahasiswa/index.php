<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
            <div class="section-header-breadcrumb">
                <a href="<?= site_url('mahasiswa/import'); ?>" class="btn btn-sm btn-success"> <i class="fa fa-book"></i> Import </a>
                <div class="p-1"></div>
                <a href="<?= site_url('mahasiswa/add'); ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah </a>
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
                            <table class="table table-striped" id='table-1'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Program Studi</th>
                                        <th>Email</th>
                                        <th>User</th>
                                        <th style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $i = 1;
                                    foreach ($student as $row) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row->nim; ?></td>
                                            <td><?= $row->name; ?></td>
                                            <td><?= $row->prodi; ?></td>
                                            <td><?= $row->email; ?></td>
                                            <td><?= $row->user ? 'Ya' : 'Tidak'; ?></td>
                                            <td>
                                                <?php if (session('role') == 'admin') : ?>
                                                    <a href="<?= site_url('mahasiswa/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                                                    <a href="<?= site_url('mahasiswa/delete/' . $row->id); ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Hapus Surat ?')"><i class="fa fa-trash"></i></a>
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