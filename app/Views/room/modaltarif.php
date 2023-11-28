    <!-- Modal Add Product-->
    <form action="<?= site_url('room/verifikasi'); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Peminjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tarif <small>(Isikan 0 bila tidak berbayar)</small></label>
                            <input type="number" class="form-control" name="biaya" value="0">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="id" class="roomid">
                        <input type="hidden" name="token" class="roomtoken">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Verifikasi</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $('.btn-verify').on('click', function() {
                const id = $(this).data('id');
                const token = $(this).data('token');
                $('.roomid').val(id);
                $('.roomtoken').val(token);
                $('#verifyModal').modal('show');
            });

        });
    </script>
    <!-- End Modal Add Product-->