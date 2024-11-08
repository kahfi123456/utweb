<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\FileModel;
use App\Models\FacultyModel;
use App\Models\DepartmentModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $fileModel;
    protected $adminModel;
    protected $facultyModel;
    protected $departmentModel;

    public function __construct()
    {
        $this->fileModel = new FileModel(); // Inisialisasi model FileModel
        $this->adminModel = new AdminModel(); // Inisialisasi model AdminModel
        $this->facultyModel = new FacultyModel(); // Inisialisasi model FacultyModel
        $this->departmentModel = new DepartmentModel(); // Inisialisasi model DepartmentModel

        // Cek apakah admin sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
    }

    public function login()
    {
        return view('admin/login');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->getAdminByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set(['isLoggedIn' => true, 'username' => $username]);
            return redirect()->to('/admin/dashboard'); // Arahkan ke dashboard
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    public function dashboard()
    {
        // Ambil data fakultas dan jurusan
        $data['faculties'] = $this->facultyModel->findAll(); // Ambil data fakultas
        $data['departments'] = $this->departmentModel->findAll(); // Ambil data jurusan
        $data['uploadedFiles'] = $this->fileModel->getUploadedFiles(); // Ambil data file yang sudah diupload

        return view('admin/dashboard', $data);
    }

    public function uploadZip()
    {
        $file = $this->request->getFile('zip_file');
        $faculty = $this->request->getPost('faculty');  // Mengambil fakultas yang dipilih
        $department = $this->request->getPost('department');  // Mengambil jurusan yang dipilih

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getName();
            $filePath = 'uploads/' . $fileName;

            // Pindahkan file ke direktori uploads
            $file->move('uploads', $fileName);

            // Simpan data file ke database
            $this->fileModel->insert([
                'faculty' => $faculty,
                'department' => $department,  // Menyimpan jurusan di database
                'filename' => $fileName,
                'file_path' => $filePath,
                'file_type' => $file->getClientMimeType(),
                'uploaded_at' => date('Y-m-d H:i:s')  // Memastikan tanggal upload ada
            ]);

            session()->setFlashdata('message', 'File berhasil diupload.');
        } else {
            session()->setFlashdata('error', 'File tidak valid atau gagal diupload.');
        }

        return redirect()->to('/admin/dashboard'); // Redirect ke halaman dashboard
    }

    public function deleteFile($id)
    {
        $file = $this->fileModel->find($id);

        if ($file) {
            $this->fileModel->delete($id);
            if (file_exists($file['file_path'])) {
                unlink($file['file_path']); // Hapus file dari server
            }
            return redirect()->to('/admin/dashboard')->with('message', 'File berhasil dihapus!');
        }

        return redirect()->to('/admin/dashboard')->with('error', 'File tidak ditemukan.');
    }

    // Menambahkan Fakultas
    public function addFaculty()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'faculty_name' => 'required|min_length[3]|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/admin/dashboard')->withInput()->with('errors', $validation->getErrors());
        }

        // Jika validasi lulus, lanjutkan dengan menambahkan fakultas
        $facultyName = $this->request->getPost('faculty_name');
        $this->facultyModel->insert(['name' => $facultyName]);
        session()->setFlashdata('message', 'Fakultas berhasil ditambahkan.');
        return redirect()->to('/admin/dashboard');
    }

    public function addDepartment()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'department_name' => 'required|min_length[3]|max_length[255]',
            'faculty_id' => 'required|is_natural_no_zero',  // Pastikan ada fakultas yang dipilih
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/admin/dashboard')->withInput()->with('errors', $validation->getErrors());
        }

        // Jika validasi lulus, lanjutkan dengan menambahkan jurusan
        $departmentName = $this->request->getPost('department_name');
        $facultyId = $this->request->getPost('faculty_id'); // ID Fakultas yang dipilih

        // Simpan data jurusan di database
        $this->departmentModel->insert([
            'name' => $departmentName,
            'faculty_id' => $facultyId
        ]);
        session()->setFlashdata('message', 'Jurusan berhasil ditambahkan.');
        return redirect()->to('/admin/dashboard');
    }

    public function editFaculty($id)
    {
        $faculty = $this->facultyModel->find($id);
        if (!$faculty) {
            session()->setFlashdata('message', 'Fakultas tidak ditemukan');
            return redirect()->to('/admin/dashboard');
        }

        // Kirim data fakultas ke view
        return view('admin/edit_faculty', ['faculty' => $faculty]);
    }

    public function editDepartment($id)
    {
        $department = $this->departmentModel->find($id);
        if (!$department) {
            session()->setFlashdata('message', 'Jurusan tidak ditemukan');
            return redirect()->to('/admin/dashboard');
        }

        // Kirim data jurusan ke view
        return view('admin/edit_department', ['department' => $department]);
    }

    public function deleteFaculty($id)
    {
        $faculty = $this->facultyModel->find($id);
        if ($faculty) {
            $this->facultyModel->delete($id);
            session()->setFlashdata('message', 'Fakultas berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Fakultas tidak ditemukan');
        }
        return redirect()->to('/admin/dashboard');
    }

    public function deleteDepartment($id)
    {
        $department = $this->departmentModel->find($id);
        if ($department) {
            $this->departmentModel->delete($id);
            session()->setFlashdata('message', 'Jurusan berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Jurusan tidak ditemukan');
        }
        return redirect()->to('/admin/dashboard');
    }
}