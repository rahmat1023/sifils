<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?>  <a href="<?= site_url('surat/keluarall'); ?>" class="btn btn-sm btn-info"> <i class="fa fa-book"></i> Tampilkan Semua Surat </a></h1>
            <div class="section-header-breadcrumb">
                <a href="<?= site_url('surat/keluar/booking'); ?>" class="btn btn-sm btn-success"> <i class="fa fa-book"></i> Booking Surat </a>
                <div class="p-1"></div>
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
                                        <th>Nomor Susun</th>
                                        <th>Pengesah</th>
                                        <th>Unit Pengajuan</th>
                                        <th>Jenis, Hal, Isi Surat</th>
                                        <th>Ditujukan</th>
                                        <th>Tanggal Surat</th>
                                        <th>Pembuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $i = 1;
                                    foreach ($keluar as $row) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row->nosusun; ?></td>
                                            <td><?= $row->pengesahname; ?></td>
                                            <td><?= $row->unitname; ?></td>
                                            <td><?= $row->jenisname . ' - <br>' . $row->halsurat . ' - <br> <p style="color:Blue">' . $row->isisurat; ?></p>
                                            </td>
                                            <td><?= $row->ditujukan; ?></td>
                                            <td><?= $row->tanggal; ?></td>
                                            <td><?= $row->pembuatname; ?></td>
                                            <td>
                                                <?php if (session('role') == 'admin' || session('id') == $row->pembuat) :
                                                    if (!$row->file) { ?>
                                                        <a href="<?= site_url('surat/keluar/upload/' . $row->id); ?>" class="btn btn-info" title="Upload"> <i class="fa fa-upload"></i> </a>
                                                    <?php } else { ?>
                                                        <a href="<?= site_url('surat/keluar/invoice/' . $row->id); ?>" class="btn btn-info" title="Lihat"> <i class="fa fa-eye"></i> </a>
                                                    <?php } ?>
                                                    <a href="<?= site_url('surat/keluar/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                                                    <a href="<?= site_url('surat/keluar/delete/' . $row->id); ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Hapus Surat ?')"><i class="fa fa-trash"></i></a>
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