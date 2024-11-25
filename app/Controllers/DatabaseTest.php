<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DatabaseTest extends Controller
{
    public function testColumn()
    {
        $db = \Config\Database::connect();
        $fields = $db->getFieldData('departments'); // Ganti dengan nama tabel Anda

        foreach ($fields as $field) {
            echo $field->name . '<br>';
        }
    }
}