<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table            = 'inventory_inventaris';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['name', 'jumlah', 'no_inv', 'dipinjam', 'foto', 'status'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
}
