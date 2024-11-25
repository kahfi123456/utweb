<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jurusan</title>
    <style>
    /* Styling untuk halaman */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        padding: 20px;
        margin: 0;
    }

    h2 {
        color: #333;
    }

    /* Styling untuk tabel */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    /* Styling untuk link edit dan hapus */
    a {
        color: #4CAF50;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Styling untuk tombol */
    .button-container {
        margin-top: 15px;
    }

    .button {
        display: inline-block;
        margin-right: 10px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>

    <h2>Kelola Jurusan</h2>

    <!-- Tombol untuk menambahkan jurusan -->
    <div class="button-container">
        <a href="add-department" class="button">Tambah Jurusan</a>
        <a href="dashboard" class="button">Kembali ke Dashboard</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departments as $index => $department): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($department['department_name']) ?></td>
                <td>
                    <a href="edit-department/<?= $department['id'] ?>">Edit</a> |
                    <a href="delete-department/<?= $department['id'] ?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?');">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>