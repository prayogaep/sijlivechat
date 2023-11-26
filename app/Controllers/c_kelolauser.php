<?php

namespace App\Controllers;

use App\Models\m_asn;
use App\Models\m_role;
use App\Models\m_kelolauser;

class c_kelolauser extends BaseController
{
    protected $user; // variable global yang bisa di akses oleh semua function
    protected $role; // variable global yang bisa di akses oleh semua function
    protected $asn; // variable global yang bisa di akses oleh semua function
    public function __construct()
    {
        $this->user = new m_kelolauser(); // jalur untuk berkomunikasi ke model m_kelolauser
        $this->role = new m_role(); // jalur untuk berkomunikasi ke model m_role
        $this->asn = new m_asn(); // jalur untuk berkomunikasi ke model m_asn
    }
    public function index() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Kelola User', // title untuk di tampilkan di tab browser
            'users' => $this->user->getFullData(), // ini berangkat ke model m_kelolauser dan masuk ke function getFullData()
        ];
        return view('user/v_user', $data); // ini akan mengarahkan ke folder views->user->v_user dengan membawa $data
    }
    public function create() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Tambah User', // title untuk di tampilkan di tab browser
            'roles' => $this->role->findAll(), // ini mengambil semua data ke model m_role
        ];
        return view('user/create', $data); // ini akan mengarahkan ke folder views->user->create dengan membawa $data
    }
    public function save() // ini yang dituju oleh routes.php
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [
            // username yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'username' => $this->request->getPost('username'), // username yang kanan menangkap nilai dari input yang name nya username

            // password yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'password' => md5($this->request->getPost('password')), // password yang kanan menangkap nilai dari input yang name nya password dan nilai aslinya disembunyikan oleh md5

            // role_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'role_id' => $this->request->getPost('role_id'), // role_id yang kanan menangkap nilai dari input yang name nya role_id
        ];

        $id = $this->user->insert($data); // mengirim data ke model m_kelolauser untuk disimpan ke database
        if ($this->request->getPost('role_id') == 3) {
            $dataAsn = [
                // nip yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'nip' => $this->request->getPost('nip'), // nip yang kanan menangkap nilai dari input yang name nya nip
                
                // nama yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'nama' => $this->request->getPost('nama'), // nama yang kanan menangkap nilai dari input yang name nya nama
                // asal_dinas yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'asal_dinas' => $this->request->getPost('asal_dinas'), // asal_dinas yang kanan menangkap nilai dari input yang name nya asal_dinas
                // jabatan yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'jabatan' => $this->request->getPost('jabatan'), // jabatan yang kanan menangkap nilai dari input yang name nya jabatan
                // alamat yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'alamat' => $this->request->getPost('alamat'), // alamat yang kanan menangkap nilai dari input yang name nya alamat
                // no_hp yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'no_hp' => $this->request->getPost('no_hp'), // no_hp yang kanan menangkap nilai dari input yang name nya no_hp
                // umur yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'umur' => $this->request->getPost('umur'), // umur yang kanan menangkap nilai dari input yang name nya umur
                // email yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'email' => $this->request->getPost('email'), // email yang kanan menangkap nilai dari input yang name nya email
                // gol_jabatan yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'gol_jabatan' => $this->request->getPost('gol_jabatan'), // gol_jabatan yang kanan menangkap nilai dari input yang name nya gol_jabatan
                
                // user_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'user_id' => $id, // $id diambil dari user terakhir yang di input
            ];

            $this->asn->insert($dataAsn);
        }

        return redirect()->to('/user')->with('success', 'Data berhasil disimpan'); // ini mengarahkan ke file routes.php dengan method get ke alamat /user
        // dengan membawa pesan
    }
    public function edit($id) // ini yang dituju oleh routes.php dan membawa data yang dipilih dari tabel
    {
        $user = $this->user->find($id); // ini mengambil semua data ke model m_kelolauser
        $data = [
            'title' => 'Edit User', // title untuk di tampilkan di tab browser
            'roles' => $this->role->findAll(), // ini mengambil semua data ke model m_role
            'user' => $user,
        ];

        if ($user['role_id'] == 3) {
            $asn = $this->asn->where('user_id', $id)->get()->getRowObject();;
            $data['objAsn'] = json_encode($asn);
            $data['asn'] = $asn;
        } 
        return view('user/edit', $data); // ini akan mengarahkan ke folder views->user->edit dengan membawa $data
    }

    public function update($id) // ini yang dituju oleh routes.php dengan membawa parameter
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [
            // username yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'username' => $this->request->getPost('username'), // username yang kanan menangkap nilai dari input yang name nya username

            // role_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'role_id' => $this->request->getPost('role_id'), // role_id yang kanan menangkap nilai dari input yang name nya role_id
        ];

        //kondisi jika password pada form edit diisi maka akan menambahkan ke dalam $data
        if ($this->request->getPost('password')) {
            // password yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user 
            $data['password'] =  md5($this->request->getPost('password')); // password yang kanan menangkap nilai dari input yang name nya password dan nilai aslinya disembunyikan oleh md5

        }

        $this->user->update($id, $data); // mengirim data ke model m_kelolauser untuk diubah ke database berdasarkan id yang dipilih
        if ($this->request->getPost('role_id') == 3) {
            $asn = $this->asn->where('user_id', $id)->get()->getRowObject();
            $dataAsn = [
                // nip yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'nip' => $this->request->getPost('nip'), // nip yang kanan menangkap nilai dari input yang name nya nip
                
                // nama yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'nama' => $this->request->getPost('nama'), // nama yang kanan menangkap nilai dari input yang name nya nama
                // asal_dinas yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'asal_dinas' => $this->request->getPost('asal_dinas'), // asal_dinas yang kanan menangkap nilai dari input yang name nya asal_dinas
                // jabatan yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'jabatan' => $this->request->getPost('jabatan'), // jabatan yang kanan menangkap nilai dari input yang name nya jabatan
                // alamat yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'alamat' => $this->request->getPost('alamat'), // alamat yang kanan menangkap nilai dari input yang name nya alamat
                // no_hp yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'no_hp' => $this->request->getPost('no_hp'), // no_hp yang kanan menangkap nilai dari input yang name nya no_hp
                // umur yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'umur' => $this->request->getPost('umur'), // umur yang kanan menangkap nilai dari input yang name nya umur
                // email yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'email' => $this->request->getPost('email'), // email yang kanan menangkap nilai dari input yang name nya email
                // gol_jabatan yang kiri adalah yang sesuai dengan kolom yang ada di tbl_asn
                'gol_jabatan' => $this->request->getPost('gol_jabatan'), // gol_jabatan yang kanan menangkap nilai dari input yang name nya gol_jabatan
            ];

            $this->asn->update($asn->id_asn, $dataAsn);
        }

        return redirect()->to('/user')->with('success', 'Data berhasil diubah'); // ini mengarahkan ke file routes.php dengan method get ke alamat /user
        // dengan membawa pesan
    }
    public function delete($id) // ini yang dituju oleh routes.php 
    {
        $this->asn->where('user_id', $id)->delete();
        $this->user->delete($id); // menghapus data ke model m_kelolauser berdasarkan id yang dipilih


        return redirect()->to('/user')->with('success', 'Data berhasil dihapus'); // ini mengarahkan ke file routes.php dengan method get ke alamat /user
        // dengan membawa pesan
    }
}
