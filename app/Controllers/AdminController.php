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
        $this->fileModel = new FileModel(); 
        $this->adminModel = new AdminModel(); 
        $this->facultyModel = new FacultyModel(); 
        $this->departmentModel = new DepartmentModel(); 

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
            return redirect()->to('/admin/dashboard'); 
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
        $data['faculties'] = $this->facultyModel->findAll(); 
        $data['departments'] = $this->departmentModel->findAll(); 
        $data['uploadedFiles'] = $this->fileModel->getUploadedFiles(); 

        return view('admin/dashboard', $data);
    }

    public function uploadZip()
    {
        $file = $this->request->getFile('zip_file');
        $faculty = $this->request->getPost('faculty');
        $department = $this->request->getPost('department'); 

        list($f1, $f2)=explode("#", $faculty);

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getName();
            $filePath = 'uploads/' . $fileName;

            $file->move('uploads', $fileName);

            $this->fileModel->insert([
                'faculty' => $f2,
                'department' => $department, 
                'filename' => $fileName,
                'file_path' => $filePath,
                'file_type' => $file->getClientMimeType(),
                'uploaded_at' => date('Y-m-d H:i:s') 
            ]);

            session()->setFlashdata('message', 'File berhasil diupload.');
        } else {
            session()->setFlashdata('error', 'File tidak valid atau gagal diupload.');
        }

        return redirect()->to('/admin/dashboard');
    }

    public function deleteFile($id)
    {
        $file = $this->fileModel->find($id);

        if ($file) {
            $this->fileModel->delete($id);
            if (file_exists($file['file_path'])) {
                unlink($file['file_path']);
            }
            return redirect()->to('/admin/dashboard')->with('message', 'File berhasil dihapus!');
        }

        return redirect()->to('/admin/dashboard')->with('error', 'File tidak ditemukan.');
    }

    public function manageFaculty()
    {
        $facultyModel = new FacultyModel();
        $data['faculties'] = $facultyModel->findAll();

        return view('admin/manage_faculty', $data);
    }

   public function addDepartmentForm()
{
    // Menampilkan form untuk menambahkan jurusan baru
    $data['faculties'] = $this->facultyModel->findAll(); // Ambil daftar fakultas
    return view('admin/add_department_form', $data);
}


public function addDepartment()
{
    // Ambil data fakultas dan jurusan
    $faculty_id = $this->request->getPost('faculty_id');
    $department_name = $this->request->getPost('department_name');

    // Validasi
    if (empty($faculty_id) || empty($department_name)) {
        return redirect()->back()->with('error', 'Data fakultas atau nama jurusan tidak boleh kosong.');
    }

    list($f2, $f1)=explode("#", $faculty_id);

    // Validasi apakah faculty_id benar ada di database
    $faculty = $this->facultyModel->find($f2);
    if (!$faculty) {
        return redirect()->back()->with('error', 'Fakultas yang dipilih tidak ditemukan.');
    }
	
    $this->departmentModel->insert([
        'name' => $f1,
        'faculty_id' => $f2,
        'department_name' => $department_name
    ]);

    // Redirect ke halaman fakultas setelah berhasil
    //return redirect()->to("/admin/manageDepartments")->with('success', 'Jurusan berhasil ditambahkan!');
    return redirect()->to("/admin/department")->with('success', 'Jurusan berhasil ditambahkan!');
}

public function manageDepartments()
{
    $departmentModel = new DepartmentModel();
    $data['departments'] = $departmentModel->findAll();
    
    // Menambahkan fakultas terkait
    foreach ($data['departments'] as &$department) {
        $faculty = $this->facultyModel->find($department['faculty_id']);
        $department['faculty_name'] = $faculty ? $faculty['name'] : 'Fakultas tidak ditemukan';
    }

    return view('admin/manage_departments', $data);
}



    public function editDepartment($id)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Jurusan tidak ditemukan");
        }

        return view('admin/edit_department_form', ['department' => $department]);
    }

    public function updateDepartment($id)
    {
        if (!$this->validate([
            'name' => 'required|min_length[3]',
        ])) {
            return redirect()->back()->withInput();
        }

        $name = $this->request->getPost('name');
        $this->departmentModel->update($id, ['department_name' => $name]);

        #return redirect()->to('/admin/manage_departments')->with('message', 'Jurusan berhasil diperbarui');
        return redirect()->to('/admin/department')->with('message', 'Jurusan berhasil diperbarui');
    }

    public function deleteDepartment($id)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Jurusan tidak ditemukan");
        }

        $this->departmentModel->delete($id);

       # return redirect()->to('/admin/manage_departments')->with('message', 'Jurusan berhasil dihapus');
        return redirect()->to('/admin/department')->with('message', 'Jurusan berhasil dihapus');
    }

    public function addFacultyForm()
    {
        return view('admin/add_faculty_form');
    }

    public function addFaculty()
    {
        $name = $this->request->getPost('name');
        $this->facultyModel->save(['name' => $name]);
        #return redirect()->to('/admin/manageFaculty')->with('message', 'Fakultas berhasil ditambahkan');
        return redirect()->to('/admin/faculty')->with('message', 'Fakultas berhasil ditambahkan');
    }

    public function deleteFaculty($id)
    {
        if ($this->facultyModel->find($id)) {
            $this->facultyModel->delete($id); 
            #return redirect()->to('/admin/manageFaculty')->with('message', 'Fakultas berhasil dihapus');
            return redirect()->to('/admin/faculty')->with('message', 'Fakultas berhasil dihapus');
        } else {
            #return redirect()->to('/admin/manageFaculty')->with('error', 'Fakultas tidak ditemukan');
            return redirect()->to('/admin/faculty')->with('error', 'Fakultas tidak ditemukan');
        }
    }

    public function editFaculty($id)
    {
        $faculty = $this->facultyModel->find($id);

        if (!$faculty) {
            #return redirect()->to('/admin/manageFaculty')->with('error', 'Fakultas tidak ditemukan');
            return redirect()->to('/admin/faculty')->with('error', 'Fakultas tidak ditemukan');
        }

        return view('admin/edit_faculty', ['faculty' => $faculty]);
    }

    public function updateFaculty($id)
    {
        $name = $this->request->getPost('name');
        $this->facultyModel->update($id, ['name' => $name]);

        #return redirect()->to('/admin/manageFaculty')->with('message', 'Fakultas berhasil diperbarui');
        return redirect()->to('/admin/faculty')->with('message', 'Fakultas berhasil diperbarui');
    }
    
}