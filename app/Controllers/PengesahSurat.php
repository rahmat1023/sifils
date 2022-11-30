<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\IncomingRequest;


class PengesahSurat extends ResourcePresenter
{
    protected $modelName = 'App\Models\PengesahSuratModel';


    /**
     * Present a view of resource objects
     * @var IncomingRequest
     *
     * @return mixed
     */
    protected $request;

    public function index()
    {
        $data['title'] = 'Daftar Pengesah Surat';
        $data['pengesah'] = $this->model->findAll();

        return view('surat/pengesah/index', $data);
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
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $data['title'] = 'Tambah Pengesah Surat';

        return view('surat/pengesah/new', $data);
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
        return redirect()->to(site_url('pengesahsurat'))->with('success', 'Berhasil menambahkan Pengesah Surat!');
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
        $data['title'] = 'Edit Pengesah Surat';
        $pengesah = $this->model->where('id', $id)->first();
        if (is_object($pengesah)) {
            $data['pengesah'] = $pengesah;
            return view('surat/pengesah/edit', $data);
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
        return redirect()->to(site_url('pengesahsurat'))->with('success', 'Berhasil mengubah Pengesah Surat!');
    }


    public function status($id)
    {
        $status = $this->model->getWhere(['id' => $id])->getRow()->hide;
        if ($status == 0) $newstatus = 1;
        if ($status == 1) $newstatus = 0;
        $data['hide'] = $newstatus;
        $this->model->update($id, $data);

        if ($this->model->affectedRows() > 0) {
            return redirect()->to(site_url('pengesahsurat'))->with('status', 'Status berhasil diubah !');
        }
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
        return redirect()->to(site_url('pengesahsurat'))->with('success', 'Pengesah Surat berhasil Dihapus!');
    }
}
