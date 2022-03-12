<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table            = 'obat';
    protected $primaryKey       = 'id_obat';
    protected $returnType       = 'object'; // array
    protected $allowedFields    = ['nama_dokter', 'nama_obat', 'dosis', 'aturan_pakai', 'jumlah'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

}
