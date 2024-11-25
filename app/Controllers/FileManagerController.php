<?php

namespace App\Controllers;

use App\Models\FileModel;
use App\Models\FacultyModel;
use App\Models\DepartmentModel;

class FileManagerController extends BaseController
{
    protected $fileModel;
    protected $logger;
    protected $facultyModel;
    protected $departmentModel;

    public function __construct()
    {
        $this->fileModel = new FileModel();
        $this->logger = \Config\Services::logger();
        $this->facultyModel = new FacultyModel();
        $this->departmentModel = new DepartmentModel();
    }

     public function index()
    {
        // Membuat instance model
        $facultyModel = new FacultyModel();

        // Mengambil data fakultas dari database
        $data['faculties'] = $facultyModel->findAll();  // Mengambil semua data fakultas

        $this->logger->info('User accessed file manager index page');

        return view('file_manager/index', $data);
    }

    public function download($id)
    {
        $file = $this->fileModel->find($id);

        if (!$file) {
            return redirect()->to('/filemanager')->with('error', 'File tidak ditemukan.');
        }

        $filePath = FCPATH . $file['file_path'];

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
            unlink($filePath);
        }

        $this->fileModel->delete($id);
        return redirect()->to('/filemanager')->with('message', 'File berhasil dihapus!');
    }

    public function upload()
    {
        return view('file_manager/upload');
    }

    public function uploadFile()
    {
        $file = $this->request->getFile('uploaded_file');
        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        $faculty = $this->request->getPost('faculty');
        $department = $this->request->getPost('department');

        if (!in_array($faculty, ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS'])) {
            return redirect()->back()->with('error', 'Fakultas tidak valid.');
        }

        $newFileName = $file->getRandomName();
        $file->move("uploads/$faculty/$department", $newFileName);

        $data = [
            'faculty' => $faculty,
            'department' => $department,
            'file_name' => $newFileName,
            'file_path' => "uploads/$faculty/$department/$newFileName",
            'uploaded_at' => date('Y-m-d H:i:s')
        ];

        $this->fileModel->insert($data);
        return redirect()->to('/filemanager')->with('message', 'File berhasil diupload.');
    }

    public function search()
    {
        $query = $this->request->getGet('query');
        $department = $this->request->getGet('department');
        $faculty = $this->request->getGet('faculty');

        if ($faculty && $department) {
            $results = $this->fileModel->like('filename', $query)
                ->where('faculty', $faculty)
                ->where('department', $department)
                ->findAll();
        } elseif ($faculty) {
            $results = $this->fileModel->like('filename', $query)
                ->where('faculty', $faculty)
                ->findAll();
        } elseif ($department) {
            $results = $this->fileModel->like('filename', $query)
                ->where('department', $department)
                ->findAll();
        } else {
            $results = $this->fileModel->like('filename', $query)
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
        $validFaculties = ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS' ];
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
        $jurusanList = $this->departmentModel->findAll();
        $data['jurusanList'] = $jurusanList;
        return view('admin/dashboard', $data);
    }

    public function faculty($faculty = null, $department = null)
    {
        $files = [];

       if ($faculty && $department) {
            $files = $this->fileModel->where('faculty', $faculty)
                ->where('department', $department)
                ->findAll();
        } elseif ($faculty) {
            $files = $this->fileModel->where('faculty', $faculty)
                ->findAll();
        } elseif ($department) {
            $files = $this->fileModel->where('department', $department)
                ->findAll();
        }
        
		
		$jurusanList = $this->departmentModel->findAll();

        return view('file_manager/faculty', [
            'faculty' => $faculty,
            'department' => $department,
            'listdepartment' => $jurusanList,
            'files' => $files,
        ]);
    }
    

  
}