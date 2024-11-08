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

// Tambahan rute untuk penambahan file ZIP khusus
$routes->get('filemanager/addSwitRoutingZip', 'FileManagerController::addSwitRoutingZip'); // Menambahkan file Swit Routing.zip ke fakultas

$routes->group('admin', function($routes) {
    // Rute login admin
    $routes->get('login', 'AdminController::login');
    $routes->post('authenticate', 'AdminController::authenticate');
    $routes->get('logout', 'AdminController::logout');
    
    // Rute dashboard admin
    $routes->get('dashboard', 'AdminController::dashboard');
    
    // Rute upload file
    $routes->get('upload', 'AdminController::uploadForm');
    $routes->post('upload', 'AdminController::uploadFile');
    $routes->get('deleteFile/(:num)', 'AdminController::deleteFile/$1');
    $routes->post('uploadZip', 'AdminController::uploadZip');
    
    // Rute untuk menambahkan fakultas
    $routes->post('addFaculty', 'AdminController::addFaculty'); // Menambahkan fakultas
    // Rute untuk menambahkan jurusan
    $routes->post('addDepartment', 'AdminController::addDepartment'); // Menambahkan jurusan

    // Rute untuk mengedit fakultas
    $routes->get('edit-faculty/(:num)', 'AdminController::editFaculty/$1'); // Edit fakultas
    $routes->post('edit-faculty/(:num)', 'AdminController::updateFaculty/$1'); // Update fakultas

    // Rute untuk mengedit jurusan
    $routes->get('edit-department/(:num)', 'AdminController::editDepartment/$1'); // Edit jurusan
    $routes->post('edit-department/(:num)', 'AdminController::updateDepartment/$1'); // Update jurusan

    // Rute untuk menghapus fakultas
    $routes->get('delete-faculty/(:num)', 'AdminController::deleteFaculty/$1'); // Hapus fakultas

    // Rute untuk menghapus jurusan
    $routes->get('delete-department/(:num)', 'AdminController::deleteDepartment/$1'); // Hapus jurusan
});

// Grup untuk Auth (jika diperlukan)
$routes->group('auth', function($routes) {
    $routes->get('login', 'AuthController::login'); // Halaman login untuk pengguna biasa
    $routes->post('loginSubmit', 'AuthController::loginSubmit'); // Proses login pengguna
    $routes->get('logout', 'AuthController::logout'); // Logout pengguna
});