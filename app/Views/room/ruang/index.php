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
                    <form action="<?= site_url('ruang'); ?>" method="POST" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-lg-6 col-xl-4">
                            <label>Periode Ketergunaan</label>
                            <select class="form-control" name="date" id="date" onchange="this.form.submit()" required>
                                <?php
                                if (isset($date)){
                                    $selected_date = $date;
                                }
                                $start_date = date('Y-m-d' , strtotime('last monday'));
                                $week = date('W', strtotime($start_date));
                                for ($i = 0; $i <= $week; $i++) {
                                    $weekstart = strtotime("$start_date - $i week");
                                    $weekend = strtotime("$start_date - $i week + 6 days");
                                    if(date('Y-m-d', $weekstart) == $selected_date) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    echo '<option value="' . date("Y-m-d", $weekstart) . '" '.$selected.'>' . date("j M Y", $weekstart) . " - " . date("j M Y", $weekend) .'</option>';
                                    echo nl2br("\n");
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                        
                    </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Ruang</th>
                                        <th>Nama Ruang</th>
                                        <th>Gedung</th>
                                        <th>Tipe Ruang</th>
                                        <th>Jenis Ruang</th>
                                        <th>Luas (m<sup>2</sup>)</th>
                                        <th>Kapasitas</th>
                                        <th>Kondisi</th>
                                        <th>Utilisasi</th>
                                        <th style="width:15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $i = 1;
                                    foreach ($ruang as $row) { 
                                        $utilisasi = 0;
                                        foreach ($room as $data){
                                            if($data->ruang == $row->id){
                                                $start = strtotime($data->start);
                                                $end = strtotime($data->end);
                                                $utilisasi += round(($end - $start)/36,2);
                                            }
                                        $persen_util = $utilisasi/40;
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row->kode; ?></td>
                                            <td><a href="<?=site_url('ruang/show/' . $row->id); ?>"><?= $row->name; ?></a></td>
                                            <td><?= $row->gedung; ?></td>
                                            <td><?= $row->tipe; ?></td>
                                            <td><?= $row->jenis; ?></td>
                                            <td><?= $row->luas == 0 ? $row->p * $row->t : $row->luas; ?> </td>
                                            <td><?= $row->kapasitas; ?></td> 
                                            <td><?= $row->kondisi; ?></td> 
                                            <td>
                                                <?=$persen_util?> %
                                                <div class="progress mb-3">
                                                <div class="progress-bar" role="progressbar" style="width: <?=$persen_util?>%" aria-valuenow="<?=$persen_util?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td> 
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