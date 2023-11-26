<?php

namespace App\Models;

use CodeIgniter\Model;

class m_kelolauser extends Model
{
    protected $table            = 'tbl_user'; // nama tabel yang ada di database
    protected $primaryKey       = 'id_user'; // kolom primary key yang ada di tabel tbl_user
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['username', 'password', 'role_id']; // Kolom yang diperbolehkan diisi dari inputan 

    function getFullData($id = null)
    {
        $this->join('tbl_role', 'tbl_user.role_id = tbl_role.id_role');
        if ($id) {
            $this->where('id_user', $id);
            return $this->get()->getRowArray();
        }
        return $this->get()->getResultArray();
    }
}
