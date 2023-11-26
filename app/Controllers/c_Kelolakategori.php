<?php

namespace App\Controllers;

use App\Models\m_kelolakategori;

class c_Kelolakategori extends BaseController
{
    protected $kategori; // variable global yang bisa di akses oleh semua function
    public function __construct()
    {
        $this->kategori = new m_kelolakategori(); // jalur untuk berkomunikasi ke model m_kelolakategori
    }
    public function index() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Kelola Kategori Aduan', // title untuk di tampilkan di tab browser
            'kategori' => $this->kategori->findAll(), // ini berangkat ke model m_kelolauser
        ];
        return view('kategori/v_kategori', $data); // ini akan mengarahkan ke folder views->kategori->v_kategori dengan membawa $data
    }
    public function create() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Tambah Kategori Aduan', // title untuk di tampilkan di tab browser
        ];
        return view('kategori/create', $data); // ini akan mengarahkan ke folder views->kategori->create dengan membawa $data
    }
    public function save() // ini yang dituju oleh routes.php
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [
            // nama_kategori yang kiri adalah yang sesuai dengan kolom yang ada di tbl_kategori
            'nama_kategori' => $this->request->getPost('nama_kategori'), // nama_kategori yang kanan menangkap nilai dari input yang name nya nama_kategori
        ];

        $this->kategori->insert($data); // mengirim data ke model m_kelolakategori untuk disimpan ke database

        return redirect()->to('/kategori')->with('success', 'Data berhasil disimpan'); // ini mengarahkan ke file routes.php dengan method get ke alamat /kategori
        // dengan membawa pesan
    }
    public function edit($id) // ini yang dituju oleh routes.php dan membawa data yang dipilih dari tabel
    {
        $data = [
            'title' => 'Edit Kategori Aduan', // title untuk di tampilkan di tab browser
            'kategori' => $this->kategori->find($id),  // ini mengambil semua data ke model m_kelolakategori
        ];

        return view('kategori/edit', $data); // ini akan mengarahkan ke folder views->kategori->edit dengan membawa $data
    }

    public function update($id) // ini yang dituju oleh routes.php dengan membawa parameter
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [
            // nama_kategori yang kiri adalah yang sesuai dengan kolom yang ada di tbl_kategori
            'nama_kategori' => $this->request->getPost('nama_kategori'), // nama_kategori yang kanan menangkap nilai dari input yang name nya nama_kategori
        ];

        $this->kategori->update($id, $data); // mengirim data ke model m_kelolakategori untuk diubah ke database berdasarkan id yang dipilih
        return redirect()->to('/kategori')->with('success', 'Data berhasil diubah'); // ini mengarahkan ke file routes.php dengan method get ke alamat /kategori
        // dengan membawa pesan
    }
    public function delete($id) // ini yang dituju oleh routes.php 
    {
        $this->kategori->delete($id); // menghapus data ke model m_kelolakategori berdasarkan id yang dipilih
        return redirect()->to('/kategori')->with('success', 'Data berhasil dihapus'); // ini mengarahkan ke file routes.php dengan method get ke alamat /kategori
        // dengan membawa pesan
    }
}
