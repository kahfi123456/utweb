<?php
// FileModel.php
namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $allowedFields = ['faculty', 'department', 'filename', 'file_path', 'created_at','faculty_id','department_id'];

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

    // Fungsi untuk menambahkan departemen baru dan mengaitkannya dengan fakultas
    public function addDepartment($department_name, $faculty_id)
    {
        // Menambahkan departemen baru
        $data = [
            'name' => $department_name,
            'faculty_id' => $faculty_id,
            'created_at' => date('Y-m-d H:i:s')
            
        ];

        return $this->db->table('departments')->insert($data); // Menyimpan data ke tabel departments
    }
    public function addFile($data)
{
    // Pastikan data memiliki faculty_id dan department_id yang valid
    if (!isset($data['faculty_id']) || !isset($data['department_id'])) {
        throw new \InvalidArgumentException("Faculty ID and Department ID are required.");
    }

    // Menyimpan data file ke database
    return $this->insert($data);
}


}