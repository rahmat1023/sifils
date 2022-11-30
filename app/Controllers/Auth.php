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
                    $params = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'role' => $user->role,
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
        ];
        session()->remove($params);
        return redirect()->to(site_url('login'));
    }
}
