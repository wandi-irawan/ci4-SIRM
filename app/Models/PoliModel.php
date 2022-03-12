<?php

namespace App\Models;

use CodeIgniter\Model;

class PoliModel extends Model
{
    protected $table            = 'poli';
    protected $primaryKey       = 'id_poli';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_poli'];
    protected $returnType       = 'object';

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

}
