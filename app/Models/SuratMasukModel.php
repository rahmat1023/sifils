<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{
    protected $table            = 'surat_masuk';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nourut', 'nosusun', 'asal', 'tanggal', 'tahun', 'ditujukan', 'halsurat', 'isisurat', 'penerima', 'pembuat', 'updated_by', 'file'];
}
