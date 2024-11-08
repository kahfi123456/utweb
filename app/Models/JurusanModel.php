<?php
namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 'jurusan'; // Nama tabel untuk model ini
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['nama_jurusan'];

    // Mendapatkan semua jurusan
    public function getAllJurusan()
    {
        return $this->findAll();
    }
}