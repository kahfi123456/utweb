<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['faculty_id', 'name'];

    public function getDepartmentsByFaculty($facultyId)
    {
        return $this->where('faculty_id', $facultyId)->findAll();
    }
}