<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateASNTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_asn' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'asal_dinas' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type'       => 'TEXT',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'umur' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'gol_jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_asn', true);
        $this->forge->addForeignKey('user_id', 'tbl_user', 'id_user');
        $this->forge->createTable('tbl_asn');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_asn');
    }
}
