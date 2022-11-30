<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Room extends BaseController
{
    public function __construct()
    {
        $this->unit = model('App\Models\UnitModel', false);
        $this->ruang = model('App\Models\RuangModel', false);
        $this->room = model('App\Models\RoomModel', false);
    }
    public function index()
    {
        $data['title'] = 'Agenda';
        $room = $this->room->getListBooking();

        foreach ($room as $key => $row) {
            $data['data'][$key]['title'] = $row->name . ' | ' . $row->ruangname;
            $data['data'][$key]['start'] = $row->start;
            $data['data'][$key]['end'] = $row->end;
            $data['data'][$key]['pic'] = $row->pic;
            $data['data'][$key]['proposal'] = $row->proposal;
            $data['data'][$key]['motor'] = $row->motor;
            $data['data'][$key]['mobil'] = $row->mobil;
            $data['data'][$key]['peserta'] = $row->peserta;
            $data['data'][$key]['acara'] = $row->acara;
            $data['data'][$key]['phone'] = $row->phone;
            $data['data'][$key]['ket'] = $row->ket;
            $data['data'][$key]['backgroundColor'] = $row->backgroundColor;
        }


        return view('room/agenda', $data);
    }

    public function booking()
    {
        $data['title'] = 'Booking Ruang';
        $data['unit'] = $this->unit->findAll();
        $data['ruang'] = $this->ruang->findAll();

        return view('room/booking', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Booking Ruang';
        $data['unit'] = $this->unit->findAll();
        $data['ruang'] = $this->ruang->findAll();
        $data['room'] = $this->room->getBooking($id);
        if (session('role') == 'admin' || session('role') == 'manager' || ($data['room']->createdBy == session('id') && $data['room']->status != 'diterima')) {
            return view('room/editbooking', $data);
        } else {
            return redirect()->to(site_url('room/bookinglist'))->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function insert()
    {
        $data = $this->request->getPost();
        $proposal = $this->request->getFile('proposal');
        if ($proposal->isValid() && !$proposal->hasMoved()) {
            $data['proposal'] = $proposal->getRandomName();
            $proposal->move('files/proposal', $data['proposal']);
        } else {
            $data['proposal'] = '';
        }
        $date = $data['tanggal'];
        $start = $data['start'];
        $end = $data['end'];
        $data['start'] =  date('Y-m-d H:i:s', strtotime("$date $start"));
        $data['end'] =  date('Y-m-d H:i:s', strtotime("$date $end"));
        $data['status'] =  'booking';
        $isOverlap = $this->room->checkAvailability($data);
        print_r($isOverlap);
        if ($isOverlap) {
            return redirect()->back()->withInput()->with('error', $isOverlap->ruangname . ' sudah dibooking untuk kegiatan ' . $isOverlap->name . ' pada tanggal ' . date('d-m-Y', strtotime($date)) . ' jam ' .  date('H:i', strtotime($isOverlap->start)) . ' - ' . date('H:i', strtotime($isOverlap->end)) . '. Silahkan pilih Ruang/Hari/Jam lain!');
        } else {
            $this->room->insert($data);
            if ($this->request->getVar('copy') == 1) {
                return redirect()->to(site_url('room/copybooking/' . $this->room->insertID()))->with('success', 'Berhasil booking Ruang!');
            } else {
                return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil booking Ruang!');
            }
        }
    }

    public function copybooking($id)
    {
        $data['title'] = 'Booking Ruang';
        $data['unit'] = $this->unit->findAll();
        $data['ruang'] = $this->ruang->findAll();
        $data['room'] = $this->room->getBooking($id);
        // d($data);
        return view('room/copybooking', $data);
    }

    public function bookinglist()
    {
        $data['title'] = 'Daftar Peminjaman';
        $data['room'] = $this->room->getListBooking();
        $data['roombyid'] = $this->room->getListBooking(session('id'));
        $data['roombooking'] = $this->room->getNewBooking();

        return view('room/bookinglist', $data);
    }

    public function delete($id)
    {
        $this->room->delete($id);
        return redirect()->to(site_url('room/bookinglist'))->with('success', 'Booking Ruang berhasil Dihapus!');
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $proposal = $this->request->getFile('proposal');
        if ($proposal->isValid() && !$proposal->hasMoved()) {
            $data['proposal'] = $proposal->getRandomName();
            $proposal->move('files/proposal', $data['proposal']);
        }
        $date = $data['tanggal'];
        $start = $data['start'];
        $end = $data['end'];
        $data['start'] =  date('Y-m-d H:i:s', strtotime("$date $start"));
        $data['end'] =  date('Y-m-d H:i:s', strtotime("$date $end"));
        $data['status'] =  'booking';
        $isOverlap = $this->room->checkAvailability($data);
        d($isOverlap);
        if ($isOverlap != null && $isOverlap->id != $id) {
            $data['id'] = $id;
            $data['error'] = $isOverlap->ruangname . ' sudah dibooking untuk kegiatan ' . $isOverlap->name . ' pada tanggal ' . date('d-m-Y', strtotime($date)) . ' jam ' .  date('H:i', strtotime($isOverlap->start)) . ' - ' . date('H:i', strtotime($isOverlap->end)) . '. Silahkan pilih Ruang/Hari/Jam lain!';
            return redirect()->back()->with('data', $data);
        } else {
            $this->room->update($id, $data);
            return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil mengubah Peminjaman Ruang!');
        }
    }

    public function accept($id)
    {
        if (session('role') == 'admin' || session('role') == 'manager') {
            $data['status'] = 'diterima';
            $this->room->update($id, $data);
            return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil menerima Peminjaman Ruang!');
        } else {
            return redirect()->to(site_url('room/bookinglist'))->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function reject($id)
    {
        if (session('role') == 'admin' || session('role') == 'manager') {
            $data['status'] = 'ditolak';
            $this->room->update($id, $data);
            return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil menolak Peminjaman Ruang!');
        } else {
            return redirect()->to(site_url('room/bookinglist'))->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function availability()
    {
        $data['title'] = 'Cek Ketersediaan Ruang';
        $data['ruang'] = $this->ruang->findAll();
        return view('room/availability', $data);
    }

    public function checkRoomAvailability()
    {
        $data = $this->request->getPost();
        $date = $data['tanggal'];
        $start = $data['start'];
        $end = $data['end'];
        $data['start'] =  date('Y-m-d H:i:s', strtotime("$date $start"));
        $data['end'] =  date('Y-m-d H:i:s', strtotime("$date $end"));
        $data['status'] =  'booking';
        $ruang = $this->ruang->find($data['ruang']);
        $isOverlap = $this->room->checkAvailability($data);
        print_r($start);
        if ($isOverlap) {
            return redirect()->back()->withInput()->with('error', $isOverlap->ruangname . ' sudah dibooking untuk kegiatan ' . $isOverlap->name . ' pada tanggal ' . date('d-m-Y', strtotime($date)) . ' jam ' .  date('H:i', strtotime($isOverlap->start)) . ' - ' . date('H:i', strtotime($isOverlap->end)) . '. Silahkan pilih Ruang/Hari/Jam lain!');
        } else {
            return redirect()->back()->withInput()->with('success', $ruang->name . ' tersedia pada tanggal ' . date('d-m-Y', strtotime($date)) . ' jam ' .  date('H:i', strtotime($start)) . ' - ' . date('H:i', strtotime($end)) . '.');
        }
    }
}
