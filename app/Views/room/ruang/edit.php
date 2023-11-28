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
                <h4>Edit Data Ruang</h4>
            </div>
            <form action="<?= site_url('ruang/update/' . $ruang->id); ?>" method="post" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Ruang</label>
                        <input type="text" class="form-control" name="kode" value="<?= $ruang->kode; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ruang</label>
                        <input type="text" class="form-control" name="name" value="<?= $ruang->name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Gedung</label>
                        <input type="text" class="form-control" name="gedung" value="<?= $ruang->gedung; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Luas</label>
                        <input type="number" step="0.01" class="form-control" name="luas" value="<?= $ruang->luas; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kapasitas</label>
                        <input type="number" class="form-control" name="kapasitas" value="<?= $ruang->kapasitas; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tipe Ruang</label>
                        <select class="form-control" name="tipe" id="tipe" required>
                            <option value="">-Pilih Ruang-</option>
                                <option value="Kuliah" <?= $ruang->tipe == 'Kuliah' ? 'selected' : ''; ?>>Ruang Kuliah</option>
                                <option value="Non-Kuliah" <?= $ruang->tipe == 'Non-Kuliah' ? 'selected' : ''; ?>>Ruang Non-Kuliah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Ruang</label>
                        <select class="form-control" name="jenis" id="jenis" required>
                            <option value="">-Pilih Ruang-</option>
                            <option value=Koridor/Selasar/Teras <?= $ruang->jenis == 'Koridor/Selasar/Teras' ? 'selected' : ''; ?>>Koridor/Selasar/Teras</option>
                            <option value=Kegiatan Mahasiswa <?= $ruang->jenis == 'Kegiatan Mahasiswa' ? 'selected' : ''; ?>>Kegiatan Mahasiswa</option>
                            <option value=Hall/Lobby <?= $ruang->jenis == 'Hall/Lobby' ? 'selected' : ''; ?>>Hall/Lobby</option>
                            <option value=Administrasi/Kantor <?= $ruang->jenis == 'Administrasi/Kantor' ? 'selected' : ''; ?>>Administrasi/Kantor</option>
                            <option value=Tangga <?= $ruang->jenis == 'Tangga' ? 'selected' : ''; ?>>Tangga</option>
                            <option value=Kuliah <?= $ruang->jenis == 'Kuliah' ? 'selected' : ''; ?>>Kuliah</option>
                            <option value=Komputer <?= $ruang->jenis == 'Komputer' ? 'selected' : ''; ?>>Komputer</option>
                            <option value=Diskusi/Tutorial/Konseling <?= $ruang->jenis == 'Diskusi/Tutorial/Konseling' ? 'selected' : ''; ?>>Diskusi/Tutorial/Konseling</option>
                            <option value=Tamu <?= $ruang->jenis == 'Tamu' ? 'selected' : ''; ?>>Tamu</option>
                            <option value=Gudang/Alat/Bahan <?= $ruang->jenis == 'Gudang/Alat/Bahan' ? 'selected' : ''; ?>>Gudang/Alat/Bahan</option>
                            <option value=Seminar <?= $ruang->jenis == 'Seminar' ? 'selected' : ''; ?>>Seminar</option>
                            <option value=Fotocopy <?= $ruang->jenis == 'Fotocopy' ? 'selected' : ''; ?>>Fotocopy</option>
                            <option value=Reference <?= $ruang->jenis == 'Reference' ? 'selected' : ''; ?>>Reference</option>
                            <option value=Ibadah <?= $ruang->jenis == 'Ibadah' ? 'selected' : ''; ?>>Ibadah</option>
                            <option value=Waiting Room <?= $ruang->jenis == 'Waiting Room' ? 'selected' : ''; ?>>Waiting Room</option>
                            <option value=Garasi <?= $ruang->jenis == 'Garasi' ? 'selected' : ''; ?>>Garasi</option>
                            <option value=Dapur/Pantry <?= $ruang->jenis == 'Dapur/Pantry' ? 'selected' : ''; ?>>Dapur/Pantry</option>
                            <option value=Kantin <?= $ruang->jenis == 'Kantin' ? 'selected' : ''; ?>>Kantin</option>
                            <option value=Rapat/Pertemuan <?= $ruang->jenis == 'Rapat/Pertemuan' ? 'selected' : ''; ?>>Rapat/Pertemuan</option>
                            <option value=Dosen <?= $ruang->jenis == 'Dosen' ? 'selected' : ''; ?>>Dosen</option>
                            <option value=Akademik <?= $ruang->jenis == 'Akademik' ? 'selected' : ''; ?>>Akademik</option>
                            <option value=Laboratorium <?= $ruang->jenis == 'Laboratorium' ? 'selected' : ''; ?>>Laboratorium</option>
                            <option value=Ketua/Kepala <?= $ruang->jenis == 'Ketua/Kepala' ? 'selected' : ''; ?>>Ketua/Kepala</option>
                            <option value=Bendahara <?= $ruang->jenis == 'Bendahara' ? 'selected' : ''; ?>>Bendahara</option>
                            <option value=Kepala Seksi <?= $ruang->jenis == 'Kepala Seksi' ? 'selected' : ''; ?>>Kepala Seksi</option>
                            <option value=Operator <?= $ruang->jenis == 'Operator' ? 'selected' : ''; ?>>Operator</option>
                            <option value=Perpustakaan <?= $ruang->jenis == 'Perpustakaan' ? 'selected' : ''; ?>>Perpustakaan</option>
                            <option value=Belajar/Baca <?= $ruang->jenis == 'Belajar/Baca' ? 'selected' : ''; ?>>Belajar/Baca</option>
                            <option value=Pengelola/Resepsionis <?= $ruang->jenis == 'Pengelola/Resepsionis' ? 'selected' : ''; ?>>Pengelola/Resepsionis</option>
                            <option value=Studio <?= $ruang->jenis == 'Studio' ? 'selected' : ''; ?>>Studio</option>
                            <option value=Pengembangan <?= $ruang->jenis == 'Pengembangan' ? 'selected' : ''; ?>>Pengembangan</option>
                            <option value=Dekan <?= $ruang->jenis == 'Dekan' ? 'selected' : ''; ?>>Dekan</option>
                            <option value=Wakil Dekan <?= $ruang->jenis == 'Wakil Dekan' ? 'selected' : ''; ?>>Wakil Dekan</option>
                            <option value=Sekretariat <?= $ruang->jenis == 'Sekretariat' ? 'selected' : ''; ?>>Sekretariat</option>
                            <option value=Ujian <?= $ruang->jenis == 'Ujian' ? 'selected' : ''; ?>>Ujian</option>
                            <option value=Istirahat/Tidur/Ganti <?= $ruang->jenis == 'Istirahat/Tidur/Ganti' ? 'selected' : ''; ?>>Istirahat/Tidur/Ganti</option>
                            <option value=Panel Listrik <?= $ruang->jenis == 'Panel Listrik' ? 'selected' : ''; ?>>Panel Listrik</option>
                            <option value=Pos jaga <?= $ruang->jenis == 'Pos jaga' ? 'selected' : ''; ?>>Pos jaga</option>
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