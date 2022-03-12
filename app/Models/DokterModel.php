<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table            = 'dokter';
    protected $primaryKey       = 'id_dokter';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_dokter', 'spesialis', 'no_telepon', 'email', 'foto'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';
}
