<?php

namespace App\Models;

use CodeIgniter\Model;

class m_kelolakategori extends Model
{
    protected $table            = 'tbl_kategori'; // nama tabel yang ada di database
    protected $primaryKey       = 'id_kategori'; // kolom primary key yang ada di tabel tbl_kategori
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_kategori']; // Kolom yang diperbolehkan diisi dari inputan     
}
