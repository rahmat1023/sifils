<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\IncomingRequest;

class Ruang extends ResourcePresenter
{
    protected $modelName = 'App\Models\RuangModel';
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest
     */
    protected $request;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $room = model('App\Models\RoomModel', false);
        if (isset($_POST['date'])) {
            $date = date("Y-m-d", strtotime($_POST['date']));
        } else {
            $date = date('Y-m-d' , strtotime('last monday'));
        }
        $data['room'] = $room->getListBookingByDate($date);
        $data['title'] = 'Daftar Ruang';
        $data['ruang'] = $this->model->findAll();
        $data['date'] = $date;

        return view('room/ruang/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $room = model('App\Models\RoomModel', false);
        $data['room'] = $room->getBookingHistoryById($id);

        $ruang = $this->model->where('id', $id)->first();
        $data['title'] = $ruang->name;
        $data['ruang'] = $ruang;
        return view('room/ruang/detail', $data);
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $data['title'] = 'Tambah Ruang';

        return view('room/ruang/new', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $data = $this->request->getPost();
        $this->model->insert($data);
        return redirect()->to(site_url('ruang'))->with('success', 'Berhasil menambahkan Ruang!');
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data['title'] = 'Edit Ruang';
        $ruang = $this->model->where('id', $id)->first();
        if (is_object($ruang)) {
            $data['ruang'] = $ruang;
            return view('room/ruang/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = $this->request->getPost();
        $this->model->update($id, $data);
        return redirect()->to(site_url('ruang'))->with('success', 'Berhasil mengubah Ruang!');
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('ruang'))->with('success', 'Ruang berhasil Dihapus!');
    }
}
