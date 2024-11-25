<?php

namespace App\Models;

use CodeIgniter\Model;

class FacultyModel extends Model
{
    protected $table = 'faculties';  // Ganti dengan nama tabel fakultas Anda
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'icon'];  // Sesuaikan dengan kolom di tabel fakultas
}