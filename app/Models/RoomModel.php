<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table            = 'room';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'name',
        'pic',
        'unit',
        'ruang',
        'phone',
        'peserta',
        'start',
        'end',
        'ket',
        'alat',
        'mobil',
        'motor',
        'acara',
        'status',
        'proposal',
        'token',
        'biaya',
        'reject',
        'verified_at',
        'accepted_at',
        'createdBy',
        'updatedBy',
    ];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;

    function getListBooking($id = null)
    {
        $builder = $this->db->table('room');
        $builder->select('room.*, room_ruang.name as ruangname, room_ruang.color as backgroundColor , unit.kode as kodeunit , users.name as creator, users.id as userid');
        $builder->join('room_ruang', 'room_ruang.id = room.ruang');
        $builder->join('unit', 'unit.id = room.unit');
        $builder->join('users', 'users.id = room.createdBy');
        if ($id) {
            $builder->where('users.id', $id);
        }
        $builder->where('room.deleted_at', NULL);
        $builder->orderBy('id', 'desc');
        $query = $builder->get()->getResult();
        return $query;
    }

    function getNewVerified()
    {
        $builder = $this->db->table('room');
        $builder->select('room.*, room_ruang.name as ruangname, room_ruang.color as ruangcolor , unit.kode as kodeunit , users.name as creator, users.id as userid');
        $builder->join('room_ruang', 'room_ruang.id = room.ruang');
        $builder->join('unit', 'unit.id = room.unit');
        $builder->join('users', 'users.id = room.createdBy');
        $builder->where('room.deleted_at', NULL);
        $builder->where('room.status', 'terverifikasi');
        $builder->orderBy('id', 'desc');
        $query = $builder->get()->getResult();
        return $query;
    }

    function getNewBooking()
    {
        $builder = $this->db->table('room');
        $builder->select('room.*, room_ruang.name as ruangname, room_ruang.color as ruangcolor , unit.kode as kodeunit , users.name as creator, users.id as userid');
        $builder->join('room_ruang', 'room_ruang.id = room.ruang');
        $builder->join('unit', 'unit.id = room.unit');
        $builder->join('users', 'users.id = room.createdBy');
        $builder->where('room.deleted_at', NULL);
        $builder->where('room.status', 'booking');
        $builder->orderBy('id', 'desc');
        $query = $builder->get()->getResult();
        return $query;
    }

    function getBooking($id)
    {
        $builder = $this->db->table('room');
        $builder->select('room.*, room_ruang.name as ruangname, room_ruang.color as ruangcolor , unit.kode as kodeunit , users.name as creator, users.id as userid');
        $builder->join('room_ruang', 'room_ruang.id = room.ruang');
        $builder->join('unit', 'unit.id = room.unit');
        $builder->join('users', 'users.id = room.createdBy');
        $builder->where('room.id', $id);
        $query = $builder->get()->getRow();
        return $query;
    }

    function getBookingToken($token)
    {
        $builder = $this->db->table('room');
        $builder->select('room.*, room_ruang.name as ruangname, room_ruang.color as ruangcolor , unit.kode as kodeunit , users.name as creator, users.id as userid');
        $builder->join('room_ruang', 'room_ruang.id = room.ruang');
        $builder->join('unit', 'unit.id = room.unit');
        $builder->join('users', 'users.id = room.createdBy');
        $builder->where('room.token', $token);
        $query = $builder->get()->getRow();
        return $query;
    }

    function getBookingToday()
    {
        $builder = $this->db->table('room');
        $builder->select('room.*, room_ruang.name as ruangname, room_ruang.color as ruangcolor , unit.kode as kodeunit , users.name as creator, users.id as userid');
        $builder->join('room_ruang', 'room_ruang.id = room.ruang');
        $builder->join('unit', 'unit.id = room.unit');
        $builder->join('users', 'users.id = room.createdBy');
        $builder->where("DATE_FORMAT(room.start, '%Y-%m-%d') = CURDATE()");
        $builder->where('room.status', 'diterima');
        $builder->where('room.deleted_at', NULL);
        $builder->orderBy('start', 'ASC');
        $query = $builder->get()->getResult();
        return $query;
    }

    function checkAvailability($data)
    {
        $builder = $this->db->table('room');
        $builder->select('room.*, room_ruang.name as ruangname, room_ruang.color as ruangcolor , unit.kode as kodeunit , users.name as creator, users.id as userid');
        $builder->join('room_ruang', 'room_ruang.id = room.ruang');
        $builder->join('unit', 'unit.id = room.unit');
        $builder->join('users', 'users.id = room.createdBy');
        $builder->where('room.ruang', $data['ruang']);
        $builder->where('room.status !=', 'ditolak');
        $builder->where('room.deleted_at', NULL);
        $builder->where('DATE_SUB(room.end, INTERVAL 1 MINUTE) >=', $data['start']);
        $builder->where('DATE_ADD(room.start, INTERVAL 1 MINUTE) <=', $data['end']);
        $query = $builder->get()->getRow();
        return $query;
    }
}
