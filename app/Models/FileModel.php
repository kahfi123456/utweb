<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $allowedFields = ['faculty', 'department', 'filename', 'file_path', 'created_at'];

    // Mendapatkan semua file yang diupload
    public function getUploadedFiles()
    {
        return $this->findAll(); // Mengambil semua data dari tabel
    }

    // Mendapatkan file berdasarkan fakultas
    public function getFilesByFaculty($faculty)
    {
        return $this->where('faculty', $faculty)->findAll(); // Mengambil data berdasarkan fakultas
    }

    // Mendapatkan file berdasarkan jurusan
    public function getFilesByDepartment($department)
    {
        return $this->where('department', $department)->findAll(); // Mengambil data berdasarkan jurusan
    }

    // Metode pencarian file berdasarkan nama file
    public function searchFiles($query, $department = null)
    {
        $this->like('filename', $query);

        if ($department) {
            $this->where('department', $department);
        }

        return $this->findAll();
    }



    // Mendapatkan file berdasarkan fakultas dan jurusan sekaligus
    public function getFilesByFacultyAndDepartment($faculty, $department)
    {
        return $this->where('faculty', $faculty)
            ->where('department', $department)
            ->findAll(); // Mengambil data berdasarkan fakultas dan jurusan
    }
}