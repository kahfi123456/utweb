<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Fakultas</title>
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

    <h2>Kelola Fakultas</h2>

    <!-- Tombol untuk menambah fakultas -->
    <div class="button-container">
        <a href="add-faculty" class="button">Tambah Fakultas</a>
        <a href="dashboard" class="button">Kembali ke Dashboard</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Fakultas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($faculties as $index => $faculty): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($faculty['name']) ?></td>
                <td>
                    <!-- Tombol Edit dan Hapus -->
                    <a href="edit-faculty/<?= $faculty['id'] ?>" class="button">Edit</a>
                    <a href="delete-faculty/<?= $faculty['id'] ?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus fakultas ini?');"
                        class="button">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>