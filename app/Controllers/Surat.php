<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;
use App\Models\UnitModel;
use App\Models\PerihalSuratModel;
use App\Models\PengesahSuratModel;
use App\Models\JenisSuratModel;

class Surat extends BaseController
{
    function __construct()
    {
        $this->masuk = new SuratMasukModel;
        $this->keluar = new SuratKeluarModel;
        // $this->unit = new UnitModel;
        // $this->perihal = new PerihalSuratModel;
        // $this->pengesah = new PengesahSuratModel;
        // $this->jenis = new JenisSuratModel;
        // $this->surat = array(
        //     'unit' => new UnitModel,
        //     'perihal' => new PerihalSuratModel,
        //     'pengesah' =>  new PengesahSuratModel,
        //     'jenis' =>  new JenisSuratModel,
        // );
        $this->unit = model('App\Models\UnitModel', false);
        $this->perihal = model('App\Models\PerihalSuratModel', false);
        $this->pengesah = model('App\Models\PengesahSuratModel', false);
        $this->jenis = model('App\Models\JenisSuratModel', false);
    }

    public function index()
    {
        return redirect()->to(site_url('surat/masuk'));
    }

    public function masuk()
    {
        if (session('surat') == 1) {
            $data['title'] = 'Daftar Surat Masuk';
            $data['masuk'] = $this->masuk->findAll();
            return view('surat/masuk/index', $data);
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function keluar()
    {
        $data['title'] = 'Daftar Surat Keluar Tahun ' . date('Y');
        $data['keluar'] = $this->keluar->getAll(date('Y'));
        return view('surat/keluar/index', $data);
    }

    public function keluarall()
    {
        $data['title'] = 'Daftar Surat Keluar';
        $data['keluar'] = $this->keluar->getAll();
        return view('surat/keluar/index', $data);
    }

    public function addmasuk()
    {
        if (session('surat') == 1) {
            $data['title'] = 'Tambah Surat Masuk';

            return view('surat/masuk/new', $data);
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function editmasuk($id)
    {
        if (session('surat') == 1) {
            $data['title'] = 'Edit Surat Masuk';
            $data['masuk'] = $this->masuk->find($id);

            return view('surat/masuk/edit', $data);
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function insertmasuk()
    {
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $data['file'] = $file->getRandomName();
            $file->move('files/suratmasuk', $data['file']);
        } else {
            $data['file'] = '';
        }
        $data['pembuat'] = session('id');
        $data['tahun'] = date('Y', strtotime($data['tanggal']));
        $this->masuk->insert($data);
        return redirect()->to(site_url('surat/masuk/'))->with('success', 'Berhasil menambahkan surat masuk!');
    }

    public function updatemasuk($id)
    {
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $data['file'] = $file->getRandomName();
            $file->move('files/suratmasuk', $data['file']);
        }
        $this->masuk->update($id, $data);
        return redirect()->to(site_url('surat/masuk/'))->with('success', 'Berhasil mengubah surat masuk!');
    }


    public function addkeluar()
    {
        $data['title'] = 'Ambil Nomor Susun Surat Keluar';
        $data['unit'] = $this->unit->findAll();
        $data['perihal'] = $this->perihal->findAll();
        $data['pengesah'] = $this->pengesah->where('hide', 0)->findAll();
        $data['jenis'] = $this->jenis->findAll();
        return view('surat/keluar/new', $data);
    }

    public function insertkeluar()
    {
        if (session('roleid') < 5) {
            $data = $this->request->getPost();
            $data['nourut'] = $this->keluar->getLastNomor()->nourut + 1;
            $tahun = date('Y', strtotime($data['tanggal']));
            $data['tahun'] = $tahun;
            if ($tahun < date('Y')){
                return redirect()->back()->withInput()->with('error', 'Anda sudah tidak boleh mengambil nomor surat untuk tahun '. $tahun.'.');
            }
            $pengesah = $this->pengesah->find($data['pengesah'])->kode;
            $perihal = $this->perihal->find($data['perihal'])->kode;
            $unit = $this->unit->find($data['unit'])->kode;
            $data['nosusun'] = $data['nourut'] . '/UN1/' . $pengesah . '/' . $unit . '/' . $perihal . '/' . $tahun;
            // print_r($data['nosusun']);
            $this->keluar->insert($data);

            return redirect()->to(site_url('surat/keluar/invoice/' . $this->keluar->insertID))->with('success', 'Berhasil mengambil nomor surat!');
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function insertbooking()
    {
        $data = $this->request->getPost();
        $data['tahun'] = date('Y', strtotime($data['tanggal']));
        $data['fakultas'] = 'Filsafat';
        $data['status'] = 'booking';
        $data['pembuat'] = session('id');
        for ($i = 0; $i < $data['jumlah']; $i++) {
            $data['nourut'] = $this->keluar->getLastNomor()->nourut + 1;
            $this->keluar->insert($data);
        }

        return redirect()->to(site_url('surat/keluar/booking'))->with('success', 'Berhasil booking nomor surat!');
    }

    public function invoicekeluar($id)
    {
        $data['title'] = 'Nomor Susun Surat Keluar';
        $data['keluar'] = $this->keluar->getByID($id);
        return view('surat/keluar/invoice', $data);
    }

    public function booking()
    {
        $data['title'] = 'Booking Nomor Susun Surat Keluar';
        if (session('role') != 'admin') {
            $data['booking'] = $this->keluar->getBookingByUser(session('id'));
        } else {
            $data['booking'] = $this->keluar->getBooking();
        }
        return view('surat/keluar/booking', $data);
    }

    public function deletemasuk($id)
    {
        if (session('surat') == 1) {
            $this->masuk->delete($id);
            return redirect()->to(site_url('surat/masuk'))->with('success', 'Surat berhasil Dihapus!');
        }
        return redirect()->to(site_url('surat/masuk'))->with('error', 'Anda tidak berhak melakukan ini');
    }

    public function deletekeluar($id)
    {
        if (session('role') == 'admin') {
            $this->keluar->delete($id);
            return redirect()->to(site_url('surat/keluar'))->with('success', 'Surat berhasil Dihapus!');
        }
        return redirect()->to(site_url('surat/keluar'))->with('error', 'Anda tidak berhak melakukan ini');
    }

    public function editkeluar($id)
    {
        $data['title'] = 'Ambil Nomor Susun Surat Keluar';
        $data['keluar'] = $this->keluar->find($id);
        $data['unit'] = $this->unit->findAll();
        $data['perihal'] = $this->perihal->findAll();
        $data['pengesah'] = $this->pengesah->findAll();
        $data['jenis'] = $this->jenis->findAll();
        if (session('role') == 'admin' || session('id') == $data['keluar']->pembuat) {
            return view('surat/keluar/edit', $data);
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function updatekeluar($id)
    {
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');
        // print_r($file);
        if ($file->isValid() && !$file->hasMoved()) {
            $data['file'] = $file->getRandomName();
            $file->move('files/suratkeluar', $data['file']);
        }
        $data['nourut'] = $this->keluar->find($id)->nourut;
        $tahun = date('Y', strtotime($data['tanggal']));
        $data['tahun'] = $tahun;
        $data['status'] = 'used';
        $pengesah = $this->pengesah->find($data['pengesah'])->kode;
        $perihal = $this->perihal->find($data['perihal'])->kode;
        $unit = $this->unit->find($data['unit'])->kode;
        $data['nosusun'] = $data['nourut'] . '/UN1/' . $pengesah . '/' . $unit . '/' . $perihal . '/' . $tahun;
        // print_r($data['nosusun']);
        $this->keluar->update($id, $data);

        return redirect()->to(site_url('surat/keluar/invoice/' . $id))->with('success', 'Berhasil mengambil nomor surat!');
    }


    public function uploadkeluar($id)
    {
        $data['title'] = 'Upload File Surat Keluar';
        $data['keluar'] = $this->keluar->find($id);
        if (session('role') == 'admin' || session('surat') == 1 || session('id') == $data['keluar']->pembuat) {
            return view('surat/keluar/uploadsurat', $data);
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function processuploadkeluar($id)
    {
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $data['file'] = $file->getRandomName();
            $file->move('files/suratkeluar', $data['file']);
            $this->keluar->update($id, $data);
            return redirect()->to(site_url('surat/keluar/invoice/' . $id))->with('success', 'Berhasil mengupload surat!');
        } else {
            return redirect()->back()->with('error', 'Upload Gagal! Silahkan coba lagi.');
        }
    }

    public function resetKeluar()
    {
        $data['title'] = 'Reset Nomor Susun Surat Keluar';
        $data['last'] = $this->keluar->getLastNomor()->nourut;
        return view('surat/keluar/reset', $data);
    }

    public function resetKeluarProcess()
    {
        $start = $this->request->getPost('number');

        $data['nourut'] = (int)$start - 1;
        $data['nosusun'] = 'RESETNUMBER';
        $data['tanggal'] = date('Y-m-d');
        $data['pembuat'] = session('id');

        $this->keluar->insert($data);

        return redirect()->to('resetkeluar')->with('success', 'Berhasil mereset nomor surat');
    }
}
