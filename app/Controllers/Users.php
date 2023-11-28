<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index()
    {
        $data['title'] = 'Daftar User';

        $users = $this->db->table('users')->get()->getResult();
        $data['users'] = $users;


        return view('users/list', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah User';
        return view('users/add', $data);
    }

    public function edit($id = null)
    {
        if ($id) {
            $data['title'] = 'Edit User';

            $data['user'] = $this->db->table('users')->getWhere(['id' => $id])->getRow();
            if ($data['user']) {
                return view('users/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['status'] = 'active';
        $this->db->table('users')->insert($data);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('users'))->with('success', 'User berhasil disimpan !');
        }
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        if($data['password'] != null){
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            $data['password'] = $data['oldpass'];
        }
        unset($data['_method']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->table('users')->where(['id' => $id])->update($data);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('users'))->with('success', 'User berhasil diubah !');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function remove($id)
    {
        $this->db->table('users')->delete(['id' => $id]);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('users'))->with('deleted', 'User berhasil hapus !');
        }
    }

    public function status($id)
    {
        $status = $this->db->table('users')->getWhere(['id' => $id])->getRow()->status;
        print_r($status);
        if ($status == 'active') $newstatus = 'inactive';
        if ($status == 'inactive') $newstatus = 'active';
        $data['status'] = $newstatus;
        d($data);
        $this->db->table('users')->where('id', $id)->update($data);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('users'))->with('status', 'Status berhasil diubah !');
        }
    }

    public function changepass()
    {
        $data['title'] = 'Edit User';
        return view('users/changepass', $data);
    }

    public function updatepass($id)
    {
        $post = $this->request->getPost();
        $data = [];
        $user = $this->db->table('users')->getWhere(['id' => $id])->getRow();
        if (password_verify($post['password'], $user->password)) {
            if ($post['newpassword'] == $post['confpassword']) {
                $data['updated_at'] = date('Y-m-d H:i:s', time());
                print_r($data);
                $data['password'] = password_hash($post['newpassword'], PASSWORD_BCRYPT);
                $this->db->table('users')->where(['id' => $id])->update($data);
                return redirect()->to(site_url())->with('success', 'Berhasil mengubah password');
            } else {
                return redirect()->back()->with('error', 'Konfirmasi Password tidak sesuai dengan password baru');
            }
        } else {
            return redirect()->back()->with('error', 'Password Lama tidak sesuai');
        }
    }
}
