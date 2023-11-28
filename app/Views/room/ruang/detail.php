<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="card col-12">
            <div class="card-header">
                <h4>Detail Ruang <?= $title; ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Kode Ruang:</strong><br>
                            <?= $ruang->kode; ?>
                        </address>
                    </div>
                    <div class="col-md-6">
                        <address>
                            <strong>Gedung:</strong><br>
                            Gedung <?= $ruang->gedung; ?>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Tipe Ruang:</strong><br>
                            <?= $ruang->tipe; ?>
                        </address>
                    </div>
                    <div class="col-md-6">
                        <address>
                            <strong>Jenis Ruang:</strong><br>
                            <?= $ruang->jenis; ?>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Luas:</strong><br>
                            <?= $ruang->luas; ?> m<sup>2</sup>
                        </address>
                    </div>
                    <div class="col-md-6">
                        <address>
                            <strong>Kapasitas:</strong><br>
                            <?= $ruang->kapasitas; ?> orang
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
                <div class="card-header">
                  <h4>Statistics</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a href="#" class="btn btn-primary">Week</a>
                      <a href="#" class="btn">Month</a>
                    </div>
                  </div>
                </div>
                <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="myChart" height="565" width="932" style="display: block; height: 452px; width: 746px;" class="chartjs-render-monitor"></canvas>
                  <div class="statistic-details mt-sm-4">
                    <div class="statistic-details-item">
                      <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</span>
                      <div class="detail-value">$243</div>
                      <div class="detail-name">Today's Sales</div>
                    </div>
                    <div class="statistic-details-item">
                      <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</span>
                      <div class="detail-value">$2,902</div>
                      <div class="detail-name">This Week's Sales</div>
                    </div>
                    <div class="statistic-details-item">
                      <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</span>
                      <div class="detail-value">$12,821</div>
                      <div class="detail-name">This Month's Sales</div>
                    </div>
                    <div class="statistic-details-item">
                      <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</span>
                      <div class="detail-value">$92,142</div>
                      <div class="detail-name">This Year's Sales</div>
                    </div>
                  </div>
                </div>
              </div>
        <div class="card col-12">
            <div class="card-header">
                <h4>Riwayat Peminjaman</h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
    <table class="table table-striped" id='table-3'>
        <thead>
            <tr>
                <th style="width: 2%;">No</th>
                <th>Nama Kegiatan</th>
                <th>PIC</th>
                <th>Waktu</th>
                <th>Pembuat</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $i = 1;
            if ($room != null) {
                foreach ($room as $row) {
            ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <?php if ($row->proposal) { ?>
                            <td><a href="<?= base_url('files/proposal/' . $row->proposal); ?>"><?= $row->name; ?></a></td>
                        <?php } else { ?>
                            <td><?= $row->name; ?></td>
                        <?php } ?>
                        <td><a href="https://wa.me/62<?= $row->phone; ?>"><?= $row->pic; ?></a></td>
                        <td><?= date('d M Y', strtotime($row->start)) . '<br>' . date('H:i', strtotime($row->start)) . '-' . date('H:i', strtotime($row->end)); ?></td>
                        <td><?= $row->creator; ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>