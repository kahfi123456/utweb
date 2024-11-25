<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Config\Services;

$routes = Services::routes();

// Rute default
$routes->get('/', 'FileManagerController::index');

// Rute utama untuk File Manager
$routes->get('filemanager', 'FileManagerController::index');
$routes->get('filemanager/faculty/(:any)', 'FileManagerController::faculty/$1'); // Rute untuk melihat fakultas tertentu
$routes->get('filemanager/faculty/(:any)/(:any)', 'FileManagerController::course/$1/$2'); // Rute untuk melihat jurusan tertentu
$routes->get('filemanager/search', 'FileManagerController::search'); // Rute untuk pencarian
$routes->get('filemanager/download/(:num)', 'FileManagerController::download/$1'); // Rute untuk mengunduh file berdasarkan ID
$routes->get('filemanager/faculty/(:num)', 'FileManagerController::faculty/$1');
$routes->get('faculty/(:num)/(:segment)', 'FacultyController::faculty/$1/$2');
$routes->get('faculty/(:num)/(:segment)', 'FacultyController::faculty/$1/$2');
$routes->get('filemanager/faculty/(:segment)/(:segment)', 'FileManagerController::faculty/$1/$2');

// Rute untuk penambahan file ZIP khusus
$routes->get('filemanager/addSwitRoutingZip', 'FileManagerController::addSwitRoutingZip'); // Menambahkan file Swit Routing.zip ke fakultas

// Grup untuk rute admin
$routes->group('admin', function($routes) {
    // Rute login admin
    $routes->get('login', 'AdminController::login');
    $routes->post('authenticate', 'AdminController::authenticate');
    $routes->get('logout', 'AdminController::logout');
    
    // Rute dashboard admin
    $routes->get('dashboard', 'AdminController::dashboard');

    // Rute untuk mengelola fakultas
    $routes->get('faculty', 'AdminController::manageFaculty'); // Menampilkan daftar fakultas
    $routes->get('admin/manageFaculty', 'AdminController::manageFaculty');

    $routes->get('add-faculty', 'AdminController::addFacultyForm'); // Form untuk menambahkan fakultas
    $routes->post('addFaculty', 'AdminController::addFaculty'); // Menambahkan fakultas
    $routes->get('edit-faculty/(:num)', 'AdminController::editFaculty/$1'); // Form edit fakultas
    $routes->post('edit-faculty/(:num)', 'AdminController::updateFaculty/$1'); // Mengupdate fakultas
    $routes->get('delete-faculty/(:num)', 'AdminController::deleteFaculty/$1'); // Menghapus fakultas

   // Rute untuk mengelola jurusan
$routes->get('department', 'AdminController::manageDepartments'); // Menampilkan daftar jurusan
 $routes->get('admin/managedepartments', 'AdminController::managedepartments');
$routes->get('add-department', 'AdminController::addDepartmentForm'); // Form untuk menambah jurusan
$routes->post('addDepartment', 'AdminController::addDepartment'); // Menambahkan jurusan
$routes->get('edit-department/(:num)', 'AdminController::editDepartment/$1'); // Form untuk edit jurusan
$routes->post('edit-department/(:num)', 'AdminController::updateDepartment/$1'); // Update jurusan
$routes->get('delete-department/(:num)', 'AdminController::deleteDepartment/$1'); // Hapus jurusan
$routes->get('departments', 'AdminController::manageDepartments');

    // Rute untuk upload file
    $routes->get('upload', 'AdminController::uploadForm');
    $routes->post('upload', 'AdminController::uploadFile');
    $routes->get('deleteFile/(:num)', 'AdminController::deleteFile/$1'); // Hapus file berdasarkan ID
    $routes->post('uploadZip', 'AdminController::uploadZip'); // Rute untuk upload file ZIP
});

// Grup untuk Auth (jika diperlukan)
$routes->group('auth', function($routes) {
    $routes->get('login', 'AuthController::login'); // Halaman login untuk pengguna biasa
    $routes->post('loginSubmit', 'AuthController::loginSubmit'); // Proses login pengguna
    $routes->get('logout', 'AuthController::logout'); // Logout pengguna
}); 