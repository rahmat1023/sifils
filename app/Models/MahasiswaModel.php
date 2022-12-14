<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'student';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nim', 'name', 'prodi', 'angkatan', 'tempat_lahir', 'tanggal_lahir', 'email', 'alamat', 'status', 'user'];
    protected $useTimestamps = true;
}
