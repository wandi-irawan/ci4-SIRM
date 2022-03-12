<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PoliMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_poli'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_poli'       => [
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

        $this->forge->addKey('id_poli', true);
        $this->forge->createTable('poli');
    }

    public function down()
    {
        $this->forge->dropTable('poli');
    }
}
