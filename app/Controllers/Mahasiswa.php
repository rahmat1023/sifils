<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    public function __construct()
    {
        $this->student = new MahasiswaModel();
    }

    public function index()
    {
        $data['title'] = 'Data Mahasiswa';
        $data['student'] = $this->student->findAll();
        return view('mahasiswa/index', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Mahasiswa';
        return view('mahasiswa/add', $data);
    }

    public function insert()
    {
        $data = $this->request->getPost();
        $this->student->insert($data);
        return redirect()->to(site_url('mahasiswa'))->with('success', 'Berhasil menambahkan Mahasiswa!');
    }

    public function edit($id)
    {
        $data['student'] = $this->student->find($id);
        $data['title'] = 'Edit Mahasiswa';
        return view('mahasiswa/edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $this->student->update($id, $data);
        return redirect()->to(site_url('mahasiswa'))->with('success', 'Berhasil mengubah Mahasiswa!');
    }
}
