<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div>
                <h1>Daftar User</h1>
            </div>
            <div class="section-header-breadcrumb">
                <a href="<?= site_url('users/add'); ?>" class="btn btn-sm btn-primary"> <i class="fa fa-user-plus"></i> Tambah User </a>
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
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. Handphone</th>
                                        <th>Hak Akses</th>
                                        <th>Status</th>
                                        <th style="width:15%">Action</th>
                                    </tr>
                                    <?php $i = 1;
                                    foreach ($users as $row) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row->name; ?></td>
                                            <td><?= $row->email; ?></td>
                                            <td><?= $row->phone; ?></td>
                                            <td class="text-capitalize"><?= $row->role; ?></td>
                                            <td>
                                                <a href="<?= site_url('users/status/' . $row->id); ?>" class="badge <?= $row->status == 'active' ? 'badge-success' : 'badge-danger'; ?> text-capitalize"><?= $row->status; ?></a>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('users/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                                                <a href="<?= site_url('users/remove/' . $row->id); ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Hapus User ?')"><i class="fa fa-trash"></i></a>
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