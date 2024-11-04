<?php
namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    
    protected $table = 'uploaded_files'; // Nama tabel yang tepat
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['faculty', 'file_name', 'file_type', 'file_path', 'uploaded_at']; // Perhatikan bahwa kolom yang benar adalah 'file_name'

    public function getAllFiles()
    {
        return $this->findAll();
        
    }

    public function addFile(array $data) // Tambahkan tipe data array
    {
        return $this->insert($data); // Menyimpan data file ke tabel uploaded_files
    }

    public function searchFiles($query)
{
    return $this->like('file_name', $query)
                ->orLike('faculty', $query) // pastikan kolom 'faculty' ada
                ->findAll();
}


    public function getFilesByFaculty($faculty)
{
    return $this->where('file_path LIKE', "uploads/$faculty/%")->findAll();
}
}