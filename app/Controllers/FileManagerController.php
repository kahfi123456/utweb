<?php

namespace App\Controllers;

use App\Models\FileModel;

class FileManagerController extends BaseController
{
    protected $fileModel;
    protected $logger;

    public function __construct()
    {
        $this->fileModel = new FileModel(); // Inisialisasi model
        $this->logger = \Config\Services::logger(); // Inisialisasi logger
    }

    public function index()
    {
        // Mendapatkan data fakultas
        $data['faculties'] = [
            ['name' => 'FE', 'icon' => 'folder-icon.png'],
            ['name' => 'FHISIP', 'icon' => 'folder-icon.png'],
            ['name' => 'FKIP', 'icon' => 'folder-icon.png'],
            ['name' => 'FST', 'icon' => 'folder-icon.png'],
            ['name' => 'PPS', 'icon' => 'folder-icon.png'],
        ];

        $this->logger->info('User accessed file manager index page');

        return view('file_manager/index', $data); // Menampilkan view index
    }

    public function download($id)
    {
        $file = $this->fileModel->find($id);

        if (!$file) {
            return redirect()->to('/filemanager')->with('error', 'File tidak ditemukan.');
        }

        $filePath = FCPATH . $file['file_path']; // Path file di server

        if (!file_exists($filePath)) {
            return redirect()->to('/filemanager')->with('error', 'File tidak ditemukan di server.');
        }

        return $this->response->download($filePath, null)->setFileName($file['file_name']);
    }

    public function addSwitRoutingZip()
    {
        $faculties = ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS'];
        $fileName = 'Swit Routing.zip';

        foreach ($faculties as $faculty) {
            $data = [
                'faculty' => $faculty,
                'file_name' => $fileName,
                'file_path' => "uploads/$faculty/$fileName",
                'uploaded_at' => date('Y-m-d H:i:s'),
            ];

            $this->fileModel->insert($data);
        }

        return redirect()->to('/filemanager')->with('message', 'File Swit Routing.zip berhasil ditambahkan ke semua fakultas');
    }

    public function delete($id)
    {
        $file = $this->fileModel->find($id);

        if (!$file) {
            return redirect()->to('/filemanager')->with('error', 'File tidak ditemukan.');
        }

        $filePath = FCPATH . $file['file_path'];

        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file dari server
        }

        $this->fileModel->delete($id);
        return redirect()->to('/filemanager')->with('message', 'File berhasil dihapus!');
    }

    public function upload()
    {
        return view('file_manager/upload'); // Menampilkan view form upload
    }

    public function uploadFile()
    {
        $file = $this->request->getFile('uploaded_file');
        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        $faculty = $this->request->getPost('faculty');
        $department = $this->request->getPost('department'); // Ambil jurusan

        if (!in_array($faculty, ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS'])) {
            return redirect()->back()->with('error', 'Fakultas tidak valid.');
        }

        $newFileName = $file->getRandomName();
        $file->move("uploads/$faculty/$department", $newFileName); // Simpan di folder fakultas/jurusan

        $data = [
            'faculty' => $faculty,
            'department' => $department, // Simpan jurusan di database
            'file_name' => $newFileName,
            'file_path' => "uploads/$faculty/$department/$newFileName",
            'uploaded_at' => date('Y-m-d H:i:s')
        ];

        $this->fileModel->insert($data); // Masukkan data ke tabel
        return redirect()->to('/filemanager')->with('message', 'File berhasil diupload.');
    }

   public function search()
{
    $query = $this->request->getGet('query');
    $department = $this->request->getGet('department');
    $faculty = $this->request->getGet('faculty');
    $model = new FileModel();

    // Cek apakah ada input fakultas atau departemen
    if ($faculty && $department) {
        // Cari berdasarkan fakultas dan departemen
        $results = $model->like('filename', $query)
                         ->where('faculty', $faculty)
                         ->where('department', $department)
                         ->findAll();
    } elseif ($faculty) {
        // Jika hanya fakultas yang dipilih
        $results = $model->like('filename', $query)
                         ->where('faculty', $faculty)
                         ->findAll();
    } elseif ($department) {
        // Jika hanya departemen yang dipilih
        $results = $model->like('filename', $query)
                         ->where('department', $department)
                         ->findAll();
    } else {
        // Jika tidak ada fakultas atau departemen yang dipilih, cari berdasarkan query saja
        $results = $model->like('filename', $query)
                         ->orLike('faculty', $query)
                         ->orLike('department', $query)
                         ->findAll();
    }

    return view('file_manager/search_results', [
        'results' => $results,
        'query' => $query,
        'faculty' => $faculty,
        'department' => $department
    ]);
}



    public function createFolder($faculty)
    {
        $folderName = $this->request->getPost('folder_name');
        $folderPath = WRITEPATH . "uploads/$faculty/$folderName";

        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0755, true);
            return redirect()->to(site_url("filemanager/faculty/$faculty"))
                ->with('message', 'Folder berhasil dibuat!');
        } else {
            return redirect()->to(site_url("filemanager/faculty/$faculty"))
                ->with('error', 'Folder sudah ada!');
        }
    }

    public function course($facultyName, $courseName)
    {
        $validFaculties = ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS'];
        if (!in_array($facultyName, $validFaculties)) {
            return redirect()->to('/filemanager')->with('error', 'Fakultas tidak valid.');
        }

        $files = $this->fileModel->getFilesByCourse($facultyName, $courseName);

        $data = [
            'faculty' => $facultyName,
            'course' => $courseName,
            'files' => $files,
        ];

        return view('file_manager/course', $data);
    }



    public function dashboard()
    {
        $jurusanModel = new \App\Models\JurusanModel(); // Membuat instance model jurusan
        $jurusanList = $jurusanModel->getAllJurusan(); // Mengambil semua jurusan

        $data['jurusanList'] = $jurusanList;
        return view('admin/dashboard', $data);
    }
    public function faculty($faculty = null, $department = null)
    {
        $files = [];

        // Pastikan fakultas dan jurusan valid
        if ($faculty && $department) {
            // Ambil file berdasarkan fakultas dan jurusan
            $files = $this->fileModel->where('faculty', $faculty)
                ->where('department', $department)
                ->findAll();
        }

        return view('file_manager/faculty', [
            'faculty' => $faculty,
            'department' => $department,
            'files' => $files,
        ]);
    }

    public function showFiles($faculty, $department)
    {
        $files = [];
        $validFaculties = ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS'];

        // Pastikan fakultas valid
        if (!in_array($faculty, $validFaculties)) {
            return redirect()->to('/filemanager')->with('error', 'Fakultas tidak valid.');
        }

        // Ambil file berdasarkan fakultas dan jurusan
        $files = $this->fileModel->where('faculty', $faculty)
            ->where('department', $department)
            ->findAll();

        return view('file_manager/faculty', [
            'faculty' => $faculty,
            'department' => $department,
            'files' => $files,
        ]);
    }
}