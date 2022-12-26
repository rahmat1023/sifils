<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

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
        $room = $this->room->getAcceptedBooking();

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
        if (session('roleid') < 6) return view('room/agenda', $data);
        else return view('room/agendapublic', $data);
    }

    public function booking()
    {
        $data['title'] = 'Booking Ruang';
        $data['unit'] = $this->unit->findAll();
        $data['ruang'] = $this->ruang->findAll();

        if (session('id')) {
            return view('room/booking', $data);
        } else {
            return view('room/guestbooking', $data);
        }
    }

    public function confirmguestbooking()
    {
        $data['title'] = 'Booking Sebagai Tamu ?';
        return view('room/confirmguest', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Booking Ruang';
        $data['unit'] = $this->unit->findAll();
        $data['ruang'] = $this->ruang->findAll();
        $data['room'] = $this->room->getBooking($id);
        if (session('role') == 'admin' || session('role') == 'manager' || session('role') == 'manager' ||  ($data['room']->createdBy == session('id') && $data['room']->status == 'booking')) {
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
        } elseif ($data['proposalcopy']) {
            $data['proposal'] = $data['proposalcopy'];
        } else {
            $data['proposal'] = '';
        }

        $date = $data['tanggal'];
        $time = Time::createFromFormat('Y-m-d', $date);
        if ((date_diff($time, Time::now())->days < 1) && session('roleid') > 2) {
            return redirect()->back()->withInput()->with('error', 'Booking ruang minimal 2 hari sebelum acara');
        }
        $start = $data['start'];
        $end = $data['end'];
        $data['start'] =  date('Y-m-d H:i:s', strtotime("$date $start"));
        $data['end'] =  date('Y-m-d H:i:s', strtotime("$date $end"));
        if (session('roleid') < 3) {
            $data['status'] =  'diterima';
        } else {
            $data['status'] =  'booking';
        }
        if ($data['token'] == NULL) {
            $data['token'] = dechex(time());
        }
        $isOverlap = $this->room->checkAvailability($data);

        if ($isOverlap) {
            return redirect()->back()->withInput()->with('error', $isOverlap->ruangname . ' sudah dibooking untuk kegiatan ' . $isOverlap->name . ' pada tanggal ' . date('d-m-Y', strtotime($date)) . ' jam ' .  date('H:i', strtotime($isOverlap->start)) . ' - ' . date('H:i', strtotime($isOverlap->end)) . '. Silahkan pilih Ruang/Hari/Jam lain!');
        } else {
            $this->room->insert($data);
            if ($this->request->getVar('copy') == 1) {
                return redirect()->to(site_url('room/copybooking/' . $this->room->insertID()))->with('success', 'Berhasil booking Ruang!');
            } else {
                if (session('id')) {
                    return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil booking Ruang!');
                } else {
                    return redirect()->to(site_url('room/bookingsuccess'))->with('token', $data['token']);
                }
            }
        }
    }

    public function copybooking($id)
    {
        $data['title'] = 'Booking Ruang';
        $data['unit'] = $this->unit->findAll();
        $data['ruang'] = $this->ruang->findAll();
        $data['room'] = $this->room->getBooking($id);
        if (session('id')) {
            return view('room/copybooking', $data);
        } else {
            return view('room/guestcopybooking', $data);
        }
    }

    public function bookingsuccess()
    {
        return view('room/bookingsuccess');
    }

    public function bookinglist()
    {
        $data['title'] = 'Daftar Peminjaman';
        $data['room'] = $this->room->getListBooking();
        $data['roombyid'] = $this->room->getListBooking(session('id'));
        $data['roombooking'] = $this->room->getNewBooking();
        $data['roomverified'] = $this->room->getNewVerified();

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
        $balasan = $this->request->getFile('balasan');
        if ($balasan->isValid() && !$balasan->hasMoved()) {
            $data['balasan'] = $balasan->getRandomName();
            $balasan->move('files/balasan', $data['balasan']);
        }
        $date = $data['tanggal'];
        $start = $data['start'];
        $end = $data['end'];
        $data['start'] =  date('Y-m-d H:i:s', strtotime("$date $start"));
        $data['end'] =  date('Y-m-d H:i:s', strtotime("$date $end"));
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
            $data['accepted_at'] = date('Y-m-d H:i:s');
            $this->room->update($id, $data);
            return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil menerima Peminjaman Ruang!');
        } else {
            return redirect()->to(site_url('room/bookinglist'))->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function verifikasi()
    {
        if (session('role') == 'admin' || session('role') == 'pimpinan') {

            $data['biaya'] = $this->request->getPost('biaya');
            $id = $this->request->getPost('id');
            $data['status'] = 'terverifikasi';
            $data['verified_at'] = date('Y-m-d H:i:s');
            // print_r($data);
            $this->room->update($id, $data);
            return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil memverifikasi Peminjaman Ruang!');
        } else {
            return redirect()->to(site_url('room/bookinglist'))->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function verifikasiToken()
    {
        if (session('role') == 'admin' || session('role') == 'pimpinan') {

            $data['biaya'] = $this->request->getPost('biaya');
            $data['token'] = $this->request->getPost('token');
            $data['status'] = 'terverifikasi';
            $data['verified_at'] = date('Y-m-d H:i:s');
            $this->room->verifyByToken($data);
            // print_r($data);
            if ($this->room->affectedRow() > 0) {
                return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil memverifikasi Peminjaman Ruang!');
            }
            return redirect()->to(site_url('room/bookinglist'))->with('error', 'Gagal memverifikasi Peminjaman Ruang!');
        } else {
            return redirect()->to(site_url('room/bookinglist'))->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function reject()
    {
        if (session('role') == 'admin' || session('role') == 'manager' || session('role') == 'pimpinan') {
            $data['reject'] = $this->request->getPost('reject');
            $id = $this->request->getPost('id');
            $data['status'] = 'ditolak';
            if (session('role') == 'pimpinan') {
                $data['verified_at'] = date('Y-m-d H:i:s');
            }
            $data['accepted_at'] = date('Y-m-d H:i:s');
            print_r($data);
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

    public function cekStatus()
    {
        $data['title'] = 'Cek Status Booking';
        if (session()->getFlashdata('data')) {
            $data['room'] = session()->getFlashdata('data');
        } else {
            $data['room'] = NULL;
        }
        return view('room/cekstatus', $data);
    }

    public function checkstatus()
    {
        $data['title'] = 'Cek Status Booking';
        $post = $this->request->getPost();
        $token = $post['token'];
        $data['room'] = $this->room->getBookingToken($token);
        if ($data['room']) {
            return redirect()->to(site_url('cekstatus'))->with('data', $data['room']);
        } else {
            return redirect()->back()->withInput()->with('error', 'Token ' . $token . ' tidak ditemukan');
        }
    }


    public function uploadbalasan($id)
    {
        $data['title'] = 'Upload Balasan Peminjaman Ruang';
        $data['id'] = $id;
        return view('room/uploadbalasan', $data);
    }

    public function postuploadbalasan($id)
    {
        $balasan = $this->request->getFile('balasan');
        if ($balasan->isValid() && !$balasan->hasMoved()) {
            $data['balasan'] = $balasan->getRandomName();
            $balasan->move('files/balasan', $data['balasan']);
        }
        $this->room->update($id, $data);
        return redirect()->to(site_url('room/bookinglist'))->with('success', 'Berhasil mengunggah surat balasan Peminjaman Ruang!');
    }
}
