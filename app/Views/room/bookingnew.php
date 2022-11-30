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
            if ($roombooking != null) {
                foreach ($roombooking as $row) { ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <?php if ($row->proposal) { ?>
                            <td><a href="<?= base_url('files/proposal/' . $row->proposal); ?>"><?= $row->name; ?></a></td>
                        <?php } else { ?>
                            <td><?= $row->name; ?></td>
                        <?php } ?>
                        <td><a href="https://wa.me/62<?= $row->phone; ?>"><?= $row->pic; ?></a></td>
                        <td><?= $row->ruangname; ?></td>
                        <td><?= date('d-m-Y', strtotime($row->start)) . '<br>' . date('H:i', strtotime($row->start)) . '-' . date('H:i', strtotime($row->end)); ?></td>
                        <td><?= $row->creator; ?></td>
                        <td><span class="badge badge-warning"><?= $row->status; ?></span></td>
                        <td>
                            <a href="<?= site_url('room/accept/' . $row->id); ?>" class="btn btn-success" title="Terima"> <i class="fa fa-check"></i> </a>
                            <a href="<?= site_url('room/reject/' . $row->id); ?>" class="btn btn-warning" title="Tolak"> <i class="fa fa-times"></i> </a>
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