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
                <h4>Tambah Ruang Baru</h4>
            </div>
            <form action="<?= site_url('ruang'); ?>" method="POST" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Ruang</label>
                        <input type="text" class="form-control" name="kode" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ruang</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Gedung</label>
                        <input type="text" class="form-control" name="gedung" required>
                    </div>
                    <div class="form-group">
                        <label>Luas</label>
                        <input type="number"  step="0.01" class="form-control" name="luas"required>
                    </div>
                    <div class="form-group">
                        <label>Kapasitas</label>
                        <input type="number" class="form-control" name="kapasitas"required>
                    </div>
                    <div class="form-group">
                        <label>Tipe Ruang</label>
                        <select class="form-control" name="tipe" id="tipe" required>
                            <option value="">-Pilih Ruang-</option>
                                <option value="Kuliah">Ruang Kuliah</option>
                                <option value="Non-Kuliah">Ruang Non-Kuliah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Ruang</label>
                        <select class="form-control" name="jenis" id="jenis" required>
                            <option value="">-Pilih Ruang-</option>
                            <option value="Koridor/Selasar/Teras">Koridor/Selasar/Teras</option>
                            <option value="Kegiatan Mahasiswa">Kegiatan Mahasiswa</option>
                            <option value="Hall/Lobby">Hall/Lobby</option>
                            <option value="Administrasi/Kantor">Administrasi/Kantor</option>
                            <option value="Tangga">Tangga</option>
                            <option value="Kuliah">Kuliah</option>
                            <option value="Komputer">Komputer</option>
                            <option value="Diskusi/Tutorial/Konseling">Diskusi/Tutorial/Konseling</option>
                            <option value="Tamu">Tamu</option>
                            <option value="Gudang/Alat/Bahan">Gudang/Alat/Bahan</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Fotocopy">Fotocopy</option>
                            <option value="Reference">Reference</option>
                            <option value="Ibadah">Ibadah</option>
                            <option value="Waiting Room">Waiting Room</option>
                            <option value="Garasi">Garasi</option>
                            <option value="Dapur/Pantry">Dapur/Pantry</option>
                            <option value="Kantin">Kantin</option>
                            <option value="Rapat/Pertemuan">Rapat/Pertemuan</option>
                            <option value="Dosen">Dosen</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Laboratorium">Laboratorium</option>
                            <option value="Ketua/Kepala">Ketua/Kepala</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Kepala Seksi">Kepala Seksi</option>
                            <option value="Operator">Operator</option>
                            <option value="Perpustakaan">Perpustakaan</option>
                            <option value="Belajar/Baca">Belajar/Baca</option>
                            <option value="Pengelola/Resepsionis">Pengelola/Resepsionis</option>
                            <option value="Studio">Studio</option>
                            <option value="Pengembangan">Pengembangan</option>
                            <option value="Dekan">Dekan</option>
                            <option value="Wakil Dekan">Wakil Dekan</option>
                            <option value="Sekretariat">Sekretariat</option>
                            <option value="Ujian">Ujian</option>
                            <option value="Istirahat/Tidur/Ganti">Istirahat/Tidur/Ganti</option>
                            <option value="Panel Listrik">Panel Listrik</option>
                            <option value="Pos jaga">Pos jaga</option>
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