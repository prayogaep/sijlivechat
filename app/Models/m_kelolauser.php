<?php

namespace App\Models;

use CodeIgniter\Model;

class m_kelolauser extends Model
{
    protected $table            = 'tbl_user'; // nama tabel yang ada di database
    protected $primaryKey       = 'id_user'; // kolom primary key yang ada di tabel tbl_user
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['username', 'password', 'role_id', 'kategori_id']; // Kolom yang diperbolehkan diisi dari inputan 

    function getFullData($id = null, $role = '',$scale = 'large')
    {
        $this->join('tbl_role', 'tbl_user.role_id = tbl_role.id_role');
        if ($id) {
            $this->where('id_user', $id);
        }
        if ($role !='') {
            if ($role == 2) {
                $this->join('tbl_kategori', 'tbl_user.kategori_id = tbl_kategori.id_kategori');
            } else if($role == 3){
                $this->join('tbl_asn', 'tbl_user.id_user = tbl_asn.user_id');
            }
            $this->where('role_id', $role);

        }
        if ($scale != 'large') {
            return $this->get()->getRowArray();
        }
        return $this->get()->getResultArray();
    }
}
