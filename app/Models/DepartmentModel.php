<?php
namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments'; // Nama tabel
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'faculty_id', 'department_name']; // Kolom yang dapat diisi
}  