<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{
    protected $table            = 'surat_keluar';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nourut', 'nosusun', 'fakultas', 'jenis', 'pengesah', 'unit', 'tanggal', 'tahun', 'perihal', 'ditujukan', 'halsurat', 'isisurat', 'sifat', 'status', 'pembuat', 'file'];

    function getAll($tahun = null)
    {
        $builder = $this->db->table('surat_keluar');
        $builder->select('surat_keluar.*, surat_jenis.name as jenisname, surat_pengesah.name as pengesahname, unit.name as unitname, surat_perihal.name as perihalname, users.name as pembuatname');
        $builder->join('surat_jenis', 'surat_jenis.id = surat_keluar.jenis');
        $builder->join('surat_pengesah', 'surat_pengesah.id = surat_keluar.pengesah');
        $builder->join('surat_perihal', 'surat_perihal.id = surat_keluar.perihal');
        $builder->join('unit', 'unit.id = surat_keluar.unit');
        $builder->join('users', 'users.id = surat_keluar.pembuat');
        $builder->where('surat_keluar.deleted_at', NULL);
        if ($tahun) {
            $builder->where('surat_keluar.tahun >=', $tahun);
        }
        $builder->orderBy('surat_keluar.id', 'DESC');
        return $builder->get()->getResult();
    }

    function getByID($id)
    {
        $builder = $this->db->table('surat_keluar');
        $builder->select('surat_keluar.*, surat_jenis.name as jenisname, surat_pengesah.name as pengesahname, unit.name as unitname, surat_perihal.name as perihalname, users.name as pembuatname');
        $builder->join('surat_jenis', 'surat_jenis.id = surat_keluar.jenis');
        $builder->join('surat_pengesah', 'surat_pengesah.id = surat_keluar.pengesah');
        $builder->join('surat_perihal', 'surat_perihal.id = surat_keluar.perihal');
        $builder->join('unit', 'unit.id = surat_keluar.unit');
        $builder->join('users', 'users.id = surat_keluar.pembuat');
        $builder->where('surat_keluar.deleted_at', NULL);
        $builder->where('surat_keluar.id =', $id);
        $builder->orderBy('surat_keluar.id', 'DESC');
        return $builder->get()->getRow();
    }

    function getLastNomor()
    {
        $builder = $this->db->table('surat_keluar');
        $builder->select('nourut');
        $builder->orderBy('id', 'DESC');
        return $builder->get()->getRow();
    }

    function getBooking($id = null)
    {
        $builder = $this->db->table('surat_keluar');
        $builder->select('surat_keluar.*, users.name as pembuatname');
        $builder->join('users', 'users.id = surat_keluar.pembuat');
        $builder->where('surat_keluar.status', 'booking');
        if ($id) {
            $builder->where('surat_keluar.id', $id);
        }
        $builder->orderBy('surat_keluar.id', 'DESC');
        return $builder->get()->getResult();
    }

    function getBookingByUSer($id)
    {
        $builder = $this->db->table('surat_keluar');
        $builder->select('surat_keluar.*, users.name as pembuatname');
        $builder->join('users', 'users.id = surat_keluar.pembuat');
        $builder->where('surat_keluar.status', 'booking');
        $builder->where('surat_keluar.deleted_at', NULL);
        if ($id) {
            $builder->where('surat_keluar.pembuat', $id);
        }
        $builder->orderBy('surat_keluar.id', 'DESC');
        return $builder->get()->getResult();
    }
    function getUnuploaded($id = null)
    {
        $builder = $this->db->table('surat_keluar');
        $builder->select('surat_keluar.*, surat_jenis.name as jenisname, surat_pengesah.name as pengesahname, unit.name as unitname, surat_perihal.name as perihalname, users.name as pembuatname');
        $builder->join('surat_jenis', 'surat_jenis.id = surat_keluar.jenis');
        $builder->join('surat_pengesah', 'surat_pengesah.id = surat_keluar.pengesah');
        $builder->join('surat_perihal', 'surat_perihal.id = surat_keluar.perihal');
        $builder->join('unit', 'unit.id = surat_keluar.unit');
        $builder->join('users', 'users.id = surat_keluar.pembuat');
        $builder->where('surat_keluar.file', '');
        $builder->where('surat_keluar.tahun >', '2021');
        $builder->where('surat_keluar.deleted_at', NULL);
        if ($id) {
            $builder->where('surat_keluar.pembuat', $id);
        }
        $builder->orderBy('surat_keluar.id', 'DESC');
        return $builder->get()->getResult();
    }
}
