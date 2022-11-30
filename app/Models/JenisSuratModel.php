<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisSuratModel extends Model
{
    protected $table            = 'surat_jenis';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['name'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
}
