<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PasienMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pasien'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_rm'       => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nik'       => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat'       => [
                'type'       => 'TEXT',
            ],
            'jenis_kelamin'       => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'agama'       => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'diagnosa'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'jenis_rawat'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'biaya'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'no_telepon'       => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'foto'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_input' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tanggal_ubah' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('id_pasien', true);
        $this->forge->addUniqueKey('no_rm');
        $this->forge->addUniqueKey('nik');
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('pasien');
    }

    public function down()
    {
        $this->forge->dropTable('pasien');
    }
}
