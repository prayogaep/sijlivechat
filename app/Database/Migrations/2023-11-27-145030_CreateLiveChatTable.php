<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLiveChatTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_livechat' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'kategori_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'keterangan' => [
                'type'       => 'TEXT',
            ],
            'tanggal_aduan' => [
                'type'       => 'DATE',
            ],
            'operator_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'tanggal_selesai' => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);
        $this->forge->addKey('id_livechat', true);
        $this->forge->addForeignKey('kategori_id', 'tbl_kategori', 'id_kategori');
        $this->forge->addForeignKey('user_id', 'tbl_user', 'id_user');
        $this->forge->addForeignKey('operator_id', 'tbl_user', 'id_user');
        $this->forge->createTable('tbl_livechat');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_livechat');
    }
}
