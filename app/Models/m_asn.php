<?php

namespace App\Models;

use CodeIgniter\Model;

class m_asn extends Model
{
    protected $table            = 'tbl_asn'; // nama tabel yang ada di database
    protected $primaryKey       = 'id_asn'; // kolom primary key yang ada di tabel tbl_asn
    protected $useAutoIncrement = true;
    protected $allowedFields    = [ 'nip','nama','asal_dinas','alamat','no_hp','email','umur','gol_jabatan', 'jabatan','user_id']; // Kolom yang diperbolehkan diisi dari inputan 

    function getFullData($id = null)
    {
        $this->join('tbl_user', 'tbl_asn.user_id = tbl_user.id_user');
        if ($id) {
            $this->where('id_asn', $id);
            return $this->get()->getRowObject();
        }
        return $this->get()->getResultArray();
    }
}
