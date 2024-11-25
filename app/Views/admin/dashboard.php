<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    /* Gaya Umum */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 30px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    header h1 {
        font-size: 28px;
        color: #333;
        margin-bottom: 8px;
    }

    nav {
        background: #357ABD;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    nav ul {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        padding: 8px 16px;
        font-weight: bold;
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.2s;
    }

    nav ul li a:hover {
        background: #4a90e2;
        transform: scale(1.05);
    }

    .notification {
        background-color: #d4edda;
        color: #155724;
        padding: 12px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
    }

    /* Form Upload */
    form label {
        font-weight: bold;
        display: block;
        margin-top: 20px;
        color: #555;
    }

    select,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-top: 8px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    button {
        background: #357ABD;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s;
        display: block;
        margin-top: 20px;
    }

    button:hover {
        background: #4a90e2;
        transform: scale(1.05);
    }

    /* Table Style */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        color: #555;
        font-size: 16px;
    }

    th {
        background-color: #357ABD;
        color: white;
        font-weight: bold;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #eaf3fd;
        cursor: pointer;
    }

    .action-buttons a {
        color: #357ABD;
        text-decoration: none;
        font-weight: bold;
        margin-right: 12px;
        transition: color 0.3s ease;
    }

    .action-buttons a:hover {
        color: #4a90e2;
    }

    footer {
        text-align: center;
        margin-top: 40px;
        color: #777;
        font-size: 14px;
    }
    </style>
    <script>
    // JavaScript untuk mengubah department (jurusan) berdasarkan fakultas yang dipilih
    function updateDepartments() {
        const faculty = document.getElementById("faculty").value;
        const departmentSelect = document.getElementById("department");
        departmentSelect.innerHTML = ""; // Kosongkan jurusan yang ada

        let departments = [];

        switch (faculty) {
            case "FE":
                departments = ["Manajemen", "Akuntansi", "Ilmu Ekonomi"];
                break;
            case "FHISIP":
                departments = ["Sosiologi", "Psikologi", "Ilmu Politik"];
                break;
            case "FKIP":
                departments = ["Pendidikan Bahasa Inggris", "Pendidikan Matematika", "Pendidikan Sejarah"];
                break;
            case "FST":
                departments = ["Ilmu Komputer", "Matematika", "Statistika"];
                break;
            case "PPS":
                departments = ["Ilmu Ekonomi Islam", "Manajemen Syariah", "Perbankan Syariah"];
                break;
            case "KDTN":
                departments = ["sistem", "ilmu gizi", "gizi"];
                break;


            default:
                // departments = [];
                const ar1 = faculty.split("#");
                //alert(ar1[1]);

                <?php $list_depart=""; foreach($departments as $dkey => $dvalue): ?>
                if (ar1[0] == <?php echo $dvalue["faculty_id"]; ?>) {
                    departments.push("<?php echo $dvalue["department_name"]; ?>");
                }
                <?php endforeach; ?>
        }

        departments.forEach(function(department) {
            const option = document.createElement("option");
            option.value = department;
            option.textContent = department;
            departmentSelect.appendChild(option);
        });
    }
    </script>
</head>

<body onload="updateDepartments()">
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
            <p>Selamat datang, <?= session()->get('username'); ?>!</p>
        </header>

        <nav>
            <ul>
                <li><a href="<?= site_url('admin/department'); ?>">Jurusan</a></li>
                <li><a href="<?= site_url('admin/faculty'); ?>">Faculty</a></li>
                <li><a href="<?= site_url('admin/logout'); ?>">Logout</a></li>
            </ul>
        </nav>


        <main>
            <h2>Manage Files</h2>

            <!-- Pesan Notifikasi -->
            <?php if (session()->getFlashdata('message')): ?>
            <div class="notification">
                <?= session()->getFlashdata('message'); ?>
            </div>
            <?php endif; ?>

            <form action="<?= site_url('admin/uploadZip') ?>" method="post" enctype="multipart/form-data">
                <label for="faculty">Fakultas:</label>
                <select name="faculty" id="faculty" required onchange="updateDepartments()">

                    <?php
						foreach($faculties as $fkey => $fvalue):
							echo"<option value='$fvalue[id]#$fvalue[name]'>$fvalue[name]</option>";
						endforeach;
					?>
                </select>

                <label for="department">Jurusan:</label>
                <select name="department" id="department" required>
                    <!-- Options for department will be dynamically added here -->
                </select>

                <label for="zip_file">File ZIP:</label>
                <input type="file" name="zip_file" id="zip_file" required>

                <button type="submit">Upload</button>
            </form>

            <h1>Uploaded Files</h1>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>File Name</th>
                        <th>Fakultas</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($uploadedFiles)): ?>
                    <?php foreach ($uploadedFiles as $index => $file): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $file['filename'] ?></td>
                        <td><?= $file['faculty'] ?></td>
                        <td class="action-buttons">
                            <a href="<?= site_url('admin/deleteFile/' . $file['id']); ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4">Tidak ada file yang diupload.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>



        </main>

        <footer>
            <p>&copy; 2024 File Manager UT. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>