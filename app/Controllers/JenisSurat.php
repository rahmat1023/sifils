<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\IncomingRequest;


class JenisSurat extends ResourcePresenter
{
    protected $modelName = 'App\Models\JenisSuratModel';


    /**
     * Present a view of resource objects
     * @var IncomingRequest
     *
     * @return mixed
     */
    protected $request;

    public function index()
    {
        $data['title'] = 'Daftar Jenis Surat';
        $data['jenis'] = $this->model->findAll();

        return view('surat/jenis/index', $data);
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
        $data['title'] = 'Tambah Jenis Surat';

        return view('surat/jenis/new', $data);
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
        return redirect()->to(site_url('jenissurat'))->with('success', 'Berhasil menambahkan Jenis Surat!');
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
        $data['title'] = 'Edit Jenis Surat';
        $jenis = $this->model->where('id', $id)->first();
        if (is_object($jenis)) {
            $data['jenis'] = $jenis;
            return view('jenissurat/edit', $data);
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
        return redirect()->to(site_url('jenissurat'))->with('success', 'Berhasil mengubah Jenis Surat!');
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
        return redirect()->to(site_url('jenissurat'))->with('success', 'Jenis Surat berhasil Dihapus!');
    }
}
