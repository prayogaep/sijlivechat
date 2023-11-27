<?php

namespace App\Controllers;

use App\Models\m_kelolauser;

class c_login extends BaseController
{
    protected $user; // variable global yang bisa diakses seluruh function
    public function __construct()
    {
        $this->user = new m_kelolauser(); // ini untuk berkomunikasi dengan model m_kelolauser
    }

    public function index() // ini yang dituju oleh routes.php
    {
        return view('login/v_login'); // ini mengarahkan ke folder views->login->v_login
    }

    public function cekLogin() // ini yang dituju oleh routes.php
    {
        $username = $this->request->getPost('username'); // menampung inputan username yang ada di view_login
        $password = MD5($this->request->getPost('password')); // menampung inputan password yang ada di view_login
        $user =  $this->user->where('username', $username)->first(); // untuk cek ke tabel user
        if (empty($user)) { // Pengecekan user tersedia atau tidak
            return redirect()->to('/')->with('error', 'Username atau Password Salah'); // mengarahkan ke routes.php dengan method get ke alamat /
        }
        if ($user['password'] != $password) { // Cek jika usernya ada tapi passwordnya salah
            return redirect()->to('/')->with('error', 'Username atau Password Salah'); // mengarahkan ke routes.php dengan method get ke alamat /
        }

        $user = $this->user->getFullData($user['id_user'], '', 'object'); // memanggil function getFullData yang ada di Model m_kelolauser
        session()->set('id_user', $user['id_user']); // Menyimpan data id_user yang ada di $user ke session
        session()->set('username', $user['username']); // Menyimpan data username yang ada di $user ke session
        session()->set('id_role', $user['role_id']); // Menyimpan data id_role yang ada di $user ke session 
        session()->set('nama_role', $user['nama_role']); // Menyimpan data nama_role yang ada di $user ke session 
        if ($user['role_id'] == 2) {
            session()->set('id_kategori', $user['kategori_id']); // Menyimpan data id_kategori yang ada di $user ke session 
        }
        return redirect()->to('/dashboard'); // mengarahkan ke routes.php dengan method get ke alamat /dashboard
    }
    public function logout() // ini yang dituju oleh routes.php
    {
        session()->destroy(); // menghapus session yang sedang login
        return redirect()->to('/'); // mengarahkan ke routes.php dengan method get ke alamat /
    }
}
