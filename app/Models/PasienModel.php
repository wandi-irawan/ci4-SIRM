<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table            = 'pasien';
    protected $primaryKey       = 'id_pasien';
    protected $returnType       = 'object';
    protected $allowedFields    = ['no_rm', 'nik', 'nama', 'alamat', 'jenis_kelamin', 'agama', 'diagnosa', 'jenis_rawat', 'biaya', 'email', 'no_telepon', 'foto'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

}
