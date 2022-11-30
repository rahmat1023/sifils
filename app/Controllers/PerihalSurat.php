<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\IncomingRequest;


class PerihalSurat extends ResourcePresenter
{
    protected $modelName = 'App\Models\PerihalSuratModel';


    /**
     * Present a view of resource objects
     * @var IncomingRequest
     *
     * @return mixed
     */
    protected $request;

    public function index()
    {
        $data['title'] = 'Daftar Perihal Surat';
        $data['perihal'] = $this->model->findAll();

        return view('surat/perihal/index', $data);
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
        $data['title'] = 'Tambah Perihal Surat';

        return view('surat/perihal/new', $data);
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
        return redirect()->to(site_url('perihalsurat'))->with('success', 'Berhasil menambahkan Perihal Surat!');
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
        $data['title'] = 'Edit Perihal Surat';
        $perihal = $this->model->where('id', $id)->first();
        if (is_object($perihal)) {
            $data['perihal'] = $perihal;
            return view('surat/perihal/edit', $data);
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
        return redirect()->to(site_url('perihalsurat'))->with('success', 'Berhasil mengubah Perihal Surat!');
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
        return redirect()->to(site_url('perihalsurat'))->with('success', 'Perihal Surat berhasil Dihapus!');
    }
}
