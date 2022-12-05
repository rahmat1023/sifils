    <!-- Modal Add Product-->
    <form action="<?= site_url('room/reject'); ?>" method="POST" autocomplete="off">
        <?= csrf_field(); ?>
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tolak Peminjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Alasan ditolak</label>
                            <input type="text" class="form-control" name="reject" placeholder="Alasan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" class="roomid">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $('.btn-reject').on('click', function() {
                const id = $(this).data('id');
                $('.roomid').val(id);
                $('#rejectModal').modal('show');
            });

        });
    </script>
    <!-- End Modal Add Product-->