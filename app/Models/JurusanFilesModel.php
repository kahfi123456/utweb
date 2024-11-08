<?php
namespace App\Models;

use CodeIgniter\Model;

class JurusanFilesModel extends Model
{
    protected $table = 'jurusan_files'; // Ganti dengan nama tabel yang sesuai
    protected $primaryKey = 'id';

    public function searchFiles($keyword, $faculty = null, $jurusanId = null)
    {
        $builder = $this->db->table($this->table);

        // Ganti 'file_name' dengan 'filename'
        $builder->like('filename', $keyword);

        // Filter berdasarkan fakultas dan jurusan jika diperlukan
        if ($faculty) {
            $builder->where('faculty', $faculty);
        }

        if ($jurusanId) {
            $builder->where('jurusan_id', $jurusanId);
        }

        return $builder->get()->getResultArray(); // Mengembalikan hasil sebagai array
    }
}