<?php

namespace App\Controllers;

use App\Models\m_kelolakategori;
use App\Models\m_livechat;

class c_livechat extends BaseController
{
    protected $kategori; // variable global yang bisa di akses oleh semua function
    protected $livechat; // variable global yang bisa di akses oleh semua function
    public function __construct()
    {
        $this->kategori = new m_kelolakategori(); // jalur untuk berkomunikasi ke model m_kelolakategori
        $this->livechat = new m_livechat(); // jalur untuk berkomunikasi ke model m_livechat
    }
    public function index() // ini yang dituju oleh routes.php
    {
        if (session('id_role') == 3) {
            $livechat = $this->livechat->getFullData(session('id_user'), 0); // ini berangkat ke model m_livechat
            $livechat_selesai = $this->livechat->getFullData(session('id_user'), 1); // ini berangkat ke model m_livechat
        } else if (session('id_role') == 2) {
            $livechat = $this->livechat->getFullData(null, 0, session('id_kategori')); // ini berangkat ke model m_livechat
            $livechat_selesai = $this->livechat->getFullData(null, 1, session('id_kategori')); // ini berangkat ke model m_livechat
        } else {
            $livechat = $this->livechat->getFullData(); // ini berangkat ke model m_livechat
            $livechat_selesai = $this->livechat->getFullData(null, 1); // ini berangkat ke model m_livechat
        }
        $data = [
            'title' => 'Livechat SIJAWARA', // title untuk di tampilkan di tab browser
            'livechat' => $livechat,
            'livechat_selesai' => $livechat_selesai,
        ];
        return view('livechat/v_livechat', $data); // ini akan mengarahkan ke folder views->livechat->v_livechat dengan membawa $data
    }
    public function create() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Livechat SIJAWARA', // title untuk di tampilkan di tab browser
            'kategori' => $this->kategori->findAll() // ini berangkat ke model m_kelolakategori
        ];
        return view('livechat/create', $data); // ini akan mengarahkan ke folder views->livechat->create dengan membawa $data
    }
    public function save() // ini yang dituju oleh routes.php
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [

            // tanggal_aduan yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'tanggal_aduan' => $this->request->getPost('tanggal_aduan'), // tanggal_aduan yang kanan menangkap nilai dari input yang name nya tanggal_aduan

            // kategori_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'kategori_id' => $this->request->getPost('kategori_id'), // kategori_id yang kanan menangkap nilai dari input yang name nya kategori_id

            // keterangan yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'keterangan' => $this->request->getPost('keterangan'), // keterangan yang kanan menangkap nilai dari input yang name nya keterangan

            // user_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'user_id' => $this->request->getPost('user_id'), // user_id yang kanan menangkap nilai dari input yang name nya user_id

            // status yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'status' => $this->request->getPost('status'), // status yang kanan menangkap nilai dari input yang name nya status
        ];

        $id = $this->livechat->insert($data); // mengirim data ke model m_livechat untuk disimpan ke database

        return redirect()->to("/livechat/detail/$id")->with('success', 'Data berhasil disimpan'); // ini mengarahkan ke file routes.php dengan method get ke alamat /livechat
        // dengan membawa pesan
    }

    public function detail($id)
    {
        $livechat = $this->livechat->getDetailAduan($id);
        $data = [
            'title' => 'Livechat SIJAWARA', // title untuk di tampilkan di tab browser
            'livechat' => $livechat
        ];
        return view('livechat/detail', $data); // ini akan mengarahkan ke folder views->livechat->detail dengan membawa $data
    }
    public function edit($id) // ini yang dituju oleh routes.php dan membawa data yang dipilih dari tabel
    {
        $livechat = $this->livechat->find($id);
        $data = [
            'title' => 'Edit Livechat SIJAWARA', // title untuk di tampilkan di tab browser
            'kategori' => $this->kategori->findAll(),  // ini mengambil semua data ke model m_livechat
            'livechat' => $livechat,  // ini mengambil semua data ke model m_livechat
        ];

        return view('livechat/edit', $data); // ini akan mengarahkan ke folder views->kategori->edit dengan membawa $data
    }

    public function update($id) // ini yang dituju oleh routes.php dengan membawa parameter
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [

            // tanggal_aduan yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'tanggal_aduan' => $this->request->getPost('tanggal_aduan'), // tanggal_aduan yang kanan menangkap nilai dari input yang name nya tanggal_aduan

            // kategori_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'kategori_id' => $this->request->getPost('kategori_id'), // kategori_id yang kanan menangkap nilai dari input yang name nya kategori_id

            // keterangan yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'keterangan' => $this->request->getPost('keterangan'), // keterangan yang kanan menangkap nilai dari input yang name nya keterangan

            // user_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'user_id' => $this->request->getPost('user_id'), // user_id yang kanan menangkap nilai dari input yang name nya user_id

            // status yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'status' => $this->request->getPost('status'), // status yang kanan menangkap nilai dari input yang name nya status
        ];

        $this->livechat->update($id, $data); // mengirim data ke model m_livechat untuk diubah ke database berdasarkan id yang dipilih
        return redirect()->to('/livechat')->with('success', 'Data berhasil diubah'); // ini mengarahkan ke file routes.php dengan method get ke alamat /livechat
        // dengan membawa pesan
    }
    public function selesai($id) // ini yang dituju oleh routes.php dengan membawa parameter
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [

            // status yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'status' => 1,
            // operator_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'operator_id' => session('id_user'),
            // tanggal_selesai yang kiri adalah yang sesuai dengan kolom yang ada di tbl_livechat
            'tanggal_selesai' => date('Y-m-d'),
        ];

        $this->livechat->update($id, $data); // mengirim data ke model m_livechat untuk diubah ke database berdasarkan id yang dipilih
        return redirect()->to('/livechat')->with('success', 'Data berhasil diubah'); // ini mengarahkan ke file routes.php dengan method get ke alamat /livechat
        // dengan membawa pesan
    }
    public function delete($id) // ini yang dituju oleh routes.php 
    {
        $this->livechat->delete($id); // menghapus data ke model m_livechat berdasarkan id yang dipilih
        return redirect()->to('/livechat')->with('success', 'Data berhasil dihapus'); // ini mengarahkan ke file routes.php dengan method get ke alamat /livechat
        // dengan membawa pesan
    }
}
