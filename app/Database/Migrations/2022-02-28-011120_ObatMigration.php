<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ObatMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_obat'          => [
                'type'           => 'INT',
                'unsigned'       => true, // frimery key
                'auto_increment' => true,
            ],
            'nama_dokter'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_obat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'dosis'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'aturan_pakai'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jumlah'       => [
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

        $this->forge->addKey('id_obat', true);
        $this->forge->createTable('obat');
    }

    public function down()
    {
        $this->forge->dropTable('obat');
    }
}
