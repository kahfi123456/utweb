<?php
namespace App\Models;

use CodeIgniter\Model;

class FacultyModel extends Model
{
    protected $table = 'faculties';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    public function getAllFaculties()
    {
        return $this->findAll();
    }
}