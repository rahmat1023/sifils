<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="card col-12 col-lg-6">
            <div class="card-header">
                <h4>Edit Data User</h4>
            </div>
            <form action="<?= site_url('users/' . $user->id); ?>" method="post" autocomplete="off">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" value="<?= $user->name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $user->email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password <small>(kosongkan jika tidak diubah)</small></label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input type="number" class="form-control" name="phone" value="<?= $user->phone; ?>">
                    </div>
                    <div class="form-group">
                        <label>Hak Akses</label>
                        <select class="form-control" name="role">
                            <option value="admin" <?= $user->role == 'admin' ? 'selected' : ''; ?>>Admin</option>
                            <option value="manager" <?= $user->role == 'manager' ? 'selected' : ''; ?>>Manager</option>
                            <option value="pimpinan" <?= $user->role == 'pimpinan' ? 'selected' : ''; ?>>Pimpinan</option>
                            <option value="employee" <?= $user->role == 'employee' ? 'selected' : ''; ?>>Tendik</option>
                            <option value="satpam" <?= $user->role == 'satpam' ? 'selected' : ''; ?>>Satpam</option>
                            <option value="user" <?= $user->role == 'user' ? 'selected' : ''; ?>>User</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-secondary"> Reset </button>
                    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-paper-plane"></i> Simpan </button>
                </div>
            </form>
        </div>

        <div class="section-body">
        </div>
    </section>
</div>
<?= $this->endSection(); ?>