<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeputusanModel;
use App\Models\UnitModel;
use App\Models\PengesahSuratModel;

class Keputusan extends BaseController
{
    function __construct()
    {
        $this->keputusan = new KeputusanModel;
        $this->unit = model('App\Models\UnitModel', false);
        $this->pengesah = model('App\Models\PengesahSuratModel', false);
    }

    public function index()
    {
        if (session('surat') == 1) {
            $data['title'] = 'Daftar Keputusan';
            $data['keputusan'] = $this->keputusan->getAll();
            return view('keputusan/index', $data);
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function add()
    {
        $data['title'] = 'Ambil Nomor Keputusan';
        $data['unit'] = $this->unit->findAll();
        $data['pengesah'] = $this->pengesah->where('keputusan', 1)->findAll();
        return view('keputusan/new', $data);
    }

    public function insert()
    {
        if (session('surat') == 1) {
            $data = $this->request->getPost();
            $data['nourut'] = $this->keputusan->getLastNomor()->nourut + 1;
            $tahun = date('Y', strtotime($data['tanggal']));
            $data['tahun'] = $tahun;
            if ($tahun < date('Y')){
                return redirect()->back()->withInput()->with('error', 'Anda sudah tidak boleh mengambil nomor keputusan untuk tahun '. $tahun.'.');
            }
            $pengesah = $this->pengesah->find($data['pengesah'])->kode;
            $unit = $this->unit->find($data['unit'])->kode;
            $data['nosusun'] = $data['nourut'] . '/UN1.' . $pengesah . '/KPT/' . $unit . '/' . $tahun;
            // print_r($data['nosusun']);
            $this->keputusan->insert($data);

            return redirect()->to(site_url('keputusan/invoice/' . $this->keputusan->insertID))->with('success', 'Berhasil mengambil nomor keputusan!');
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function invoice($id)
    {
        $data['title'] = 'Nomor Susun Keputusan';
        $data['keputusan'] = $this->keputusan->getByID($id);
        return view('keputusan/invoice', $data);
    }

    public function delete($id)
    {
        if (session('role') == 'admin') {
            $this->keputusan->delete($id);
            return redirect()->to(site_url('keputusan'))->with('success', 'Keputusan berhasil Dihapus!');
        }
        return redirect()->to(site_url('keputusan'))->with('error', 'Anda tidak berhak melakukan ini');
    }

    public function edit($id)
    {
        $data['title'] = 'Ambil Nomor Susun Keputusan';
        $data['keputusan'] = $this->keputusan->find($id);
        $data['unit'] = $this->unit->findAll();
        $data['pengesah'] = $this->pengesah->findAll();
        if (session('role') == 'admin' || session('id') == $data['keputusan']->pembuat) {
            return view('keputusan/edit', $data);
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');
        // print_r($file);
        if ($file->isValid() && !$file->hasMoved()) {
            $data['file'] = $file->getRandomName();
            $file->move('files/keputusan', $data['file']);
        }
        $data['nourut'] = $this->keputusan->find($id)->nourut;
        $tahun = date('Y', strtotime($data['tanggal']));
        $data['tahun'] = $tahun;
        $data['status'] = 'used';
        $pengesah = $this->pengesah->find($data['pengesah'])->kode;
        $unit = $this->unit->find($data['unit'])->kode;
        $data['nosusun'] = $data['nourut'] . '/UN1.' . $pengesah . '/KPT/' . $unit . '/' . $tahun;
        // print_r($data['nosusun']);
        $this->keputusan->update($id, $data);

        return redirect()->to(site_url('keputusan/invoice/' . $id))->with('success', 'Berhasil mengambil nomor surat!');
    }


    public function upload($id)
    {
        $data['title'] = 'Upload File Surat Keputusan';
        $data['keputusan'] = $this->keputusan->find($id);
        if (session('role') == 'admin' || session('surat') == 1 || session('id') == $data['keputusan']->pembuat) {
            return view('keputusan/upload', $data);
        } else {
            return redirect()->to(site_url())->with('error', 'Anda tidak berhak melakukan ini');
        }
    }

    public function processupload($id)
    {
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $keputusan = $this->keputusan->find($id);
            $data['file'] = $keputusan->isi . ' ' . date('d M Y', strtotime($keputusan->tanggal));
            $file->move('files/keputusan', $data['file']);
            $this->keputusan->update($id, $data);
            return redirect()->to(site_url('keputusan/invoice/' . $id))->with('success', 'Berhasil mengupload surat!');
        } else {
            return redirect()->back()->with('error', 'Upload Gagal! Silahkan coba lagi.');
        }
    }

    public function reset()
    {
        $data['title'] = 'Reset Nomor Keputusan';
        $data['last'] = $this->keputusan->getLastNomor()->nourut;
        return view('keputusan/reset', $data);
    }

    public function resetKeputusan()
    {
        $start = $this->request->getPost('number');

        $data['nourut'] = (int)$start - 1;
        $data['nosusun'] = 'RESETNUMBER';
        $data['tanggal'] = date('Y-m-d');
        $data['pembuat'] = session('id');

        $this->keputusan->insert($data);

        return redirect()->to('reset')->with('success', 'Berhasil mereset keputusan');
    }
}