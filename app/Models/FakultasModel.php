<?php
namespace App\Models;

use CodeIgniter\Model;

class FakultasModel extends Model
{
    protected $table = 'faculties'; // Tabel fakultas
    protected $primaryKey = 'id'; // Sesuaikan dengan nama primary key di tabel Anda
    protected $allowedFields = ['name', 'icon']; // Sesuaikan dengan kolom yang ada di tabel

    public function getAllFakultas()
    {
        return $this->findAll(); // Mengambil semua fakultas
    }
}