<?php

namespace App\Models;

use CodeIgniter\Model;

class m_role extends Model
{
    protected $table            = 'tbl_role';
    protected $primaryKey       = 'id_role';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_role'];
}
