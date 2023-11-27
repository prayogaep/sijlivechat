<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'role_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'kategori_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addForeignKey('role_id', 'tbl_role', 'id_role');
        $this->forge->addForeignKey('kategori_id', 'tbl_kategori', 'id_kategori');
        $this->forge->createTable('tbl_user');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user');
    }
}
