<div class="table-responsive">
    <table class="table table-striped" id='table-1'>
        <thead>
            <tr>
                <th style="width: 2%;">No</th>
                <th>Nama Kegiatan</th>
                <th>PIC</th>
                <th>Ruang</th>
                <th>Waktu</th>
                <th>Pembuat</th>
                <th>Status</th>
                <th style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $i = 1;
            if (session('role') == 'pimpinan') $data = $roombooking;
            if (session('role') == 'manager') $data = $roomverified;
            if (session('role') == 'admin') $data = (object) array_merge((array) $roomverified, (array) $roombooking);

            if ($data != null) {
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <?php if ($row->proposal) { ?>
                            <td><a href="<?= base_url('files/proposal/' . $row->proposal); ?>"><?= $row->name; ?></a></td>
                        <?php } else { ?>
                            <td><?= $row->name; ?></td>
                        <?php } ?>
                        <td><a href="https://wa.me/62<?= $row->phone; ?>"><?= $row->pic; ?></a></td>
                        <td><?= $row->ruangname; ?> <?php if ($row->biaya > 0) {
                                                        helper('number');
                                                    ?> <span class="badge badge-info"><?= number_to_currency($row->biaya, 'IDR', 'id_ID', 0); ?></span> <?php } ?> </td>
                        <td><?= date('d M Y', strtotime($row->start)) . '<br>' . date('H:i', strtotime($row->start)) . '-' . date('H:i', strtotime($row->end)); ?></td>
                        <td><?= $row->creator; ?></td>
                        <td><span class="badge badge-<?= $row->status == 'booking' ? 'warning' : 'primary'; ?>"><?= $row->status; ?></span></td>
                        <td>
                            <?php
                            if (session('role') == 'admin' || session('role') == 'manager') {
                            ?>
                                <a href="<?= site_url('room/accept/' . $row->id); ?>" class="btn btn-success" title="Terima"> <i class="fa fa-check"></i> </a>
                            <?php } elseif (session('role') == 'pimpinan') { ?>
                                <a href="#" class="btn btn-success btn-verify" data-id="<?= $row->id; ?>" data-token="<?= $row->token; ?>" title="Verifikasi" data-toggle="modal" data-target="#verifyModal"> <i class="fa fa-check"></i> </a>
                            <?php } ?>
                            <a href="#" class="btn btn-warning btn-reject" data-id="<?= $row->id; ?>" title="Tolak" data-toggle="modal" data-target="#rejectModal"> <i class="fa fa-times"></i> </a>
                            <a href="<?= site_url('room/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                            <form action="<?= site_url('room/delete/' . $row->id); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus Booking Ruang ?')">
                                <?= csrf_field(); ?>
                                <button class="btn btn-danger" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>