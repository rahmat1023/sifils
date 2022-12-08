<div class="table-responsive">
    <table class="table table-striped" id='table-2'>
        <thead>
            <tr>
                <th style="width: 2%;">No</th>
                <th>Nama Kegiatan</th>
                <th>PIC</th>
                <th>Ruang</th>
                <th>Waktu</th>
                <th>Pembuat</th>
                <th>Status</th>
                <th style="width:15%">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $i = 1;
            if ($roombyid != null) {
                foreach ($roombyid as $row) {
                    if ($row->status == 'booking') {
                        $color = 'warning';
                    } elseif ($row->status = 'diterima') {
                        $color = 'success';
                    } elseif ($row->status = 'ditolak') {
                        $color = 'danger';
                    }
            ?>
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
                                                    ?> <span class="badge badge-info"><?= number_to_currency($row->biaya, 'IDR', 'id_ID', 0); ?></span> <?php } ?></td>
                        <td><?= date('d-m-Y', strtotime($row->start)) . '<br>' . date('H:i', strtotime($row->start)) . '-' . date('H:i', strtotime($row->end)); ?></td>
                        <td><?= $row->creator; ?></td>
                        <td><span class="badge badge-<?= $color; ?>"><?= $row->status; ?></span></td>
                        <?php if ($row->status != 'diterima' || session('role') == 'admin' || session('role')  == 'manager') { ?>
                            <td>
                                <a href="<?= site_url('room/edit/' . $row->id); ?>" class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-alt"></i> </a>
                                <form action="<?= site_url('room/delete/' . $row->id); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus Booking Ruang ?')">
                                    <?= csrf_field(); ?>
                                    <button class="btn btn-danger" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        <?php } else {
                            echo '<td></td>';
                        } ?>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>