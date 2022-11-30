<?php

namespace App\Models;

use CodeIgniter\Model;

class PengesahSuratModel extends Model
{
    protected $table            = 'surat_pengesah';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['kode', 'name', 'jabatan', 'hide'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
}
