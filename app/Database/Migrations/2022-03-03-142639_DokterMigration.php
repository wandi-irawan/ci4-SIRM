<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DokterMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dokter'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_dokter'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'spesialis'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_telepon'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'foto'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_input' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tanggal_ubah' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_dokter', true);
        $this->forge->createTable('dokter');
    }

    public function down()
    {
        $this->forge->dropTable('dokter');
    }
}
