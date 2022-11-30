<?php

namespace App\Models;

use CodeIgniter\Model;

class PerihalSuratModel extends Model
{
    protected $table            = 'surat_perihal';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['kode', 'name'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
}
