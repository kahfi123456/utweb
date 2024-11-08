<?php

namespace App\Models;

use CodeIgniter\Model;

class FileFacultyModel extends Model
{
    protected $table = 'files'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['faculty', 'filename', 'file_path', 'created_at' ]; // Sesuaikan dengan kolom tabel

    // Fungsi untuk mengambil file berdasarkan fakultas
    public function getFilesByFaculty($faculty)
    {
        return $this->where('faculty', $faculty)->findAll(); // Mengambil semua file untuk fakultas tertentu
    }
}