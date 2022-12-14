<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        //
    }

    public function login()
    {
        $room = model('App\Models\RoomModel', false);
        $data['booking'] = $room->getBookingToday();

        if (session('id')) {
            return redirect()->to(site_url());
        }
        return view('auth/login', $data);
    }

    public function loginProcess()
    {
        $post = $this->request->getPost();
        $user = $this->db->table('users')->getWhere(['email' => $post['email']])->getRow();

        if ($user) {
            if (password_verify($post['password'], $user->password)) {
                if ($user->status == 'active') {
                    if ($user->role == 'admin') $roleid = 1;
                    if ($user->role == 'manager') $roleid = 2;
                    if ($user->role == 'pimpinan') $roleid = 3;
                    if ($user->role == 'employee') $roleid = 4;
                    if ($user->role == 'satpam') $roleid = 5;
                    if ($user->role == 'user') $roleid = 6;
                    $params = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'role' => $user->role,
                        'roleid' => $roleid,
                        'surat' => $user->role_surat,
                    ];
                    session()->set($params);
                    print_r(session('id'));
                    return redirect()->to(site_url());
                } else {
                    return redirect()->back()->with('error', 'Akun Anda tidak aktif, silakan hubungi Admin');
                }
            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function logout()
    {
        $params = [
            'id',
            'name',
            'role',
            'roleid',
            'surat',
        ];
        session()->remove($params);
        return redirect()->to(site_url('login'));
    }

    public function inputnim()
    {

        if (session('id')) {
            return redirect()->to(site_url());
        }
        return view('auth/inputnim');
    }

    public function inputnimprocess()
    {
        $post = $this->request->getPost();
        $student = $this->db->table('student')->getWhere(['nim' => $post['nim'], 'email' => $post['email']])->getRow();
        if ($student) {
            if ($student->user) {
                return redirect()->back()->with('error', 'Anda sudah terdaftar, silahkan login');
            }
            return redirect()->to(site_url('register'))->with('data', $student);
        } else {
            return redirect()->back()->withInput()->with('error', 'NIM dan/atau Email tidak cocok/tidak ditemukan, silakan cek kembali');
        }
    }

    public function register()
    {
        if (session()->getFlashdata('data')) {
            $data = json_decode(json_encode(session()->getFlashdata('data')), true);
            // print_r($data);
            return view('auth/register', $data);
        } else {
            return redirect()->to(site_url('inputnim'));
        }
    }

    public function registerprocess()
    {
        $post = $this->request->getPost();
        if (sha1($post['password']) == sha1($post['passconf'])) {
            $insertData['name'] = $post['name'];
            $insertData['password'] = password_hash($post['password'], PASSWORD_BCRYPT);;
            $insertData['email'] = $post['email'];
            $insertData['phone'] = $post['phone'];
            $insertData['role'] = 'user';
            $insertData['status'] = 'active';
            $this->db->table('users')->insert($insertData);
            $data['user'] = $this->db->table('users')->orderBy('id', 'DESC')->get()->getRow('id');
            $this->db->table('student')->update($data, ['id' => $post['sid']]);
            return redirect()->to(site_url('login'))->with('success', 'Berhasil membuat akun, silakan login');
        } else {
            return redirect()->to(site_url('inputnim'))->with('error', 'Password dan Konfirmasi tidak sesuai, slakan ulangi lagi.');
        }
    }
}
