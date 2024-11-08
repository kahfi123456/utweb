<?php
namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // Nama tabel admin
    protected $allowedFields = ['username', 'password'];

    public function getAdminByUsername($username)
    {
        return $this->where('username', $username)->first(); // Mengambil data admin berdasarkan username
    }
}