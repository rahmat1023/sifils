<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->room = model('App\Models\RoomModel', false);

        $data['title'] = 'Dashboard';
        $data['booking'] = $this->db->table('room')->getWhere(['status' => 'booking', 'deleted_at' => NULL])->getNumRows();
        $data['agenda'] = $this->db->table('room')->where("DATE_FORMAT(start, '%Y-%m-%d') >= CURDATE()")->get()->getNumRows();
        $data['masuk'] = $this->db->table('surat_masuk')->getWhere(['deleted_at' => NULL])->getNumRows();
        $data['keluar'] = $this->db->table('surat_keluar')->getWhere(['deleted_at' => NULL])->getNumRows();
        $data['roombooking'] = $this->room->getNewBooking();

        return view('home', $data);
    }
}
