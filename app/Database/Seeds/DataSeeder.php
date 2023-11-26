<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_role' => 'Admin',
        ];
        $this->db->table('tbl_role')->insert($data);

        $data = [
            'nama_role' => 'Operator',
        ];
        $this->db->table('tbl_role')->insert($data);
        $data = [
            'nama_role' => 'ASN',
        ];

        // Using Query Builder
        $this->db->table('tbl_role')->insert($data);

        // Membuat User
        $role = $this->db->query("SELECT id_role FROM tbl_role WHERE nama_role = 'Admin'")->getRowObject();
        $data = [
            'username' => 'admin',
            'password' => md5('password'),
            'role_id' => $role->id_role
        ];
        $this->db->table('tbl_user')->insert($data);
    }
}
