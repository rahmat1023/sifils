<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangModel extends Model
{
    protected $table            = 'room_ruang';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['name', 'gedung', 'p', 'l', 't', 'kapasitas', 'fasilitas', 'color', 'foto', 'status'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
}
