<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File untuk <?= esc($faculty) ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css') ?>">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: aquamarine;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
        max-width: 150px;
        margin: 0 auto 20px;
        display: block;
    }

    .welcome-text,
    .faculty-options,
    .back-button {
        text-align: center;
    }

    .faculty-options {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        margin: 20px 0;
    }

    .faculty-button {
        display: inline-block;
        padding: 15px;
        background-color: #0073e6;
        color: #fff;
        border-radius: 5px;
        font-weight: bold;
        transition: 0.3s;
        text-align: center;
        text-decoration: none;
    }

    .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: rgba(22, 100, 210, 0.6);
        color: black;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: rgba(244, 67, 54, 0.8);
    }

    .faculty-button:hover {
        background-color: rgba(22, 100, 0, 0.2);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:hover {
        background-color: rgba(0, 115, 230, 0.1);
    }

    .download-btn {
        display: inline-block;
        padding: 8px 12px;
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .download-btn:hover {
        background-color: #218838;
    }
    </style>
</head>

<body>
    <div class="container">
        <img src="<?= base_url('images/ut_logo.png') ?>" alt="Logo Universitas Terbuka" class="logo">

        <div class="welcome-text">
            <h1>Selamat Datang Di File Manager Materi Pengayaan Universitas Terbuka</h1>
            <p>- Silahkan Memilih Materi Pengayaan berdasarkan fakultas atau gunakan Fitur Pencarian pada folder yang
                telah dipilih untuk memudahkan pencarian Materi Pengayaan.</p>
        </div>

        <h2>Pilih Jurusan</h2>
        <div class="faculty-options">
            <?php if ($faculty === 'FE'): ?>
            <a href="<?= base_url('filemanager/faculty/FE/Manajemen'); ?>" class="faculty-button">Manajemen</a>
            <a href="<?= base_url('filemanager/faculty/FE/Akuntansi'); ?>" class="faculty-button">Akuntansi</a>
            <a href="<?= base_url('filemanager/faculty/FE/Ilmu Ekonomi'); ?>" class="faculty-button">Ilmu Ekonomi</a>
            <?php elseif ($faculty === 'FHISIP'): ?>
            <a href="<?= base_url('filemanager/faculty/FHISIP/Ilmu Politik'); ?>" class="faculty-button">Ilmu
                Politik</a>
            <a href="<?= base_url('filemanager/faculty/FHISIP/Sosiologi'); ?>" class="faculty-button">Sosiologi</a>
            <a href="<?= base_url('filemanager/faculty/FHISIP/Psikologi'); ?>" class="faculty-button">Psikologi</a>
            <?php elseif ($faculty === 'FKIP'): ?>
            <a href="<?= base_url('filemanager/faculty/FKIP/Pendidikan Bahasa Inggris'); ?>"
                class="faculty-button">Pendidikan Bahasa Inggris</a>
            <a href="<?= base_url('filemanager/faculty/FKIP/Pendidikan Matematika'); ?>"
                class="faculty-button">Pendidikan Matematika</a>
            <a href="<?= base_url('filemanager/faculty/FKIP/Pendidikan Sejarah'); ?>" class="faculty-button">Pendidikan
                Sejarah</a>
            <?php elseif ($faculty === 'FST'): ?>
            <a href="<?= base_url('filemanager/faculty/FST/Ilmu Komputer'); ?>" class="faculty-button">Ilmu Komputer</a>
            <a href="<?= base_url('filemanager/faculty/FST/Matematika'); ?>" class="faculty-button">Matematika</a>
            <a href="<?= base_url('filemanager/faculty/FST/Statistika'); ?>" class="faculty-button">Statistika</a>
            <?php elseif ($faculty === 'PPS'): ?>
            <a href="<?= base_url('filemanager/faculty/PPS/Ilmu Ekonomi Islam'); ?>" class="faculty-button">Ilmu Ekonomi
                Islam</a>
            <a href="<?= base_url('filemanager/faculty/PPS/Manajemen Syariah'); ?>" class="faculty-button">Manajemen
                Syariah</a>
            <a href="<?= base_url('filemanager/faculty/PPS/Perbankan Syariah'); ?>" class="faculty-button">Perbankan
                Syariah</a>
            <?php else: ?>
            <p>Fakultas tidak ditemukan atau tidak valid.</p>
            <?php endif; ?>
        </div>


        <h2>Daftar File untuk Jurusan <?= esc($faculty) ?> - <?= esc($department) ?></h2>
        <?php if (!empty($files)): ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama File</th>
                    <th>Unduh</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $index => $file): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><a href="<?= base_url($file['file_path']); ?>"
                            target="_blank"><?= esc($file['filename']); ?></a></td>
                    <td><a href="<?= base_url($file['file_path']); ?>" class="download-btn" download>Unduh ZIP</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>Tidak ada file untuk jurusan ini.</p>
        <?php endif; ?>

        <a href="<?= site_url('/filemanager') ?>" class="back-button">Kembali ke Halaman Utama</a>
    </div>
</body>

</html>