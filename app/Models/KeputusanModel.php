<?php

namespace App\Models;

use CodeIgniter\Model;

class KeputusanModel extends Model
{
    protected $table            = 'keputusan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nourut', 'nosusun', 'pengesah', 'unit', 'tanggal', 'tahun', 'ditujukan', 'isi',  'status', 'pembuat', 'file'];

    function getAll($tahun = null)
    {
        $builder = $this->db->table('keputusan');
        $builder->select('keputusan.*, surat_pengesah.name as pengesahname, unit.name as unitname, users.name as pembuatname');
        $builder->join('surat_pengesah', 'surat_pengesah.id = keputusan.pengesah');
        $builder->join('unit', 'unit.id = keputusan.unit');
        $builder->join('users', 'users.id = keputusan.pembuat');
        $builder->where('keputusan.deleted_at', NULL);
        if ($tahun) {
            $builder->where('keputusan.tahun >=', $tahun);
        }
        $builder->orderBy('keputusan.id', 'DESC');
        return $builder->get()->getResult();
    }

    function getByID($id)
    {
        $builder = $this->db->table('keputusan');
        $builder->select('keputusan.*, surat_pengesah.name as pengesahname, unit.name as unitname, users.name as pembuatname');
        $builder->join('surat_pengesah', 'surat_pengesah.id = keputusan.pengesah');
        $builder->join('unit', 'unit.id = keputusan.unit');
        $builder->join('users', 'users.id = keputusan.pembuat');
        $builder->where('keputusan.deleted_at', NULL);
        $builder->where('keputusan.id =', $id);
        $builder->orderBy('keputusan.id', 'DESC');
        return $builder->get()->getRow();
    }

    function getLastNomor()
    {
        $builder = $this->db->table('keputusan');
        $builder->select('nourut');
        $builder->orderBy('id', 'DESC');
        return $builder->get()->getRow();
    }

    function getBooking($id = null)
    {
        $builder = $this->db->table('keputusan');
        $builder->select('keputusan.*, users.name as pembuatname');
        $builder->join('users', 'users.id = keputusan.pembuat');
        $builder->where('keputusan.status', 'booking');
        if ($id) {
            $builder->where('keputusan.id', $id);
        }
        $builder->orderBy('keputusan.id', 'DESC');
        return $builder->get()->getResult();
    }

    function getBookingByUSer($id)
    {
        $builder = $this->db->table('keputusan');
        $builder->select('keputusan.*, users.name as pembuatname');
        $builder->join('users', 'users.id = keputusan.pembuat');
        $builder->where('keputusan.status', 'booking');
        $builder->where('keputusan.deleted_at', NULL);
        if ($id) {
            $builder->where('keputusan.pembuat', $id);
        }
        $builder->orderBy('keputusan.id', 'DESC');
        return $builder->get()->getResult();
    }
    function getUnuploaded($id = null)
    {
        $builder = $this->db->table('keputusan');
        $builder->select('keputusan.*, surat_jenis.name as jenisname, surat_pengesah.name as pengesahname, unit.name as unitname, surat_perihal.name as perihalname, users.name as pembuatname');
        $builder->join('surat_pengesah', 'surat_pengesah.id = keputusan.pengesah');
        $builder->join('unit', 'unit.id = keputusan.unit');
        $builder->join('users', 'users.id = keputusan.pembuat');
        $builder->where('keputusan.file', '');
        $builder->where('keputusan.deleted_at', NULL);
        if ($id) {
            $builder->where('keputusan.pembuat', $id);
        }
        $builder->orderBy('keputusan.id', 'DESC');
        return $builder->get()->getResult();
    }
}
