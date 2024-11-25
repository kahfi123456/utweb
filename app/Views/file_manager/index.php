<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager Materi Pengayaan</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css') ?>">
    <style>
    /* Tambahkan styling tambahan untuk tampilan */
    body {
        font-family: Arial, sans-serif;
        background-color: aquamarine;
        margin: 0;
        /* Menghapus margin default */
        padding: 0;
        /* Menghapus padding default */
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        /* Menambahkan margin vertikal */
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
        max-width: 150px;
        display: block;
        margin: 0 auto 20px;
    }

    .welcome-text {
        text-align: center;
        margin-bottom: 20px;
        background: whitesmoke;
    }

    h1,
    h2 {
        color: #333;
        /* Warna teks untuk heading */
    }

    .faculty-list {
        display: flex;
        justify-content: space-between;
        /* Mengubah untuk penggunaan yang lebih baik */
        flex-wrap: wrap;
        /* Membuat responsif pada layar kecil */
        margin-top: 20px;
    }

    .faculty-list a {
        flex: 1;
        /* Mengatur lebar link fakultas agar fleksibel */
        padding: 10px 15px;
        color: #fff;
        /* Mengubah warna teks link menjadi putih */
        text-align: center;
        /* Mengatur teks rata tengah */
        text-decoration: none;
        border-radius: 5px;

        /* Warna latar belakang link */
        margin: 5px;
        /* Menambahkan jarak antar link */
        transition: background-color 0.3s;
        /* Efek transisi pada hover */
    }

    .faculty-list a:hover {
        background-color: rgba(0, 0, 0, 0.1);
        /* Warna latar belakang saat hover */
    }

    .search-bar {
        margin-top: 20px;
        text-align: center;
    }

    .search-bar input[type="text"] {
        padding: 10px;
        width: 70%;
        margin-right: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .search-bar button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        background-color: #28a745;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
        /* Efek transisi pada hover */
    }

    .search-bar button:hover {
        background-color: #218838;
    }

    ul {
        padding: 0;
        /* Menghapus padding dari ul */
        list-style-type: none;
        /* Menghapus bullet points */
    }

    ul li {
        padding: 5px 0;
    }

    ul li a {
        text-decoration: none;
        /* Menghapus underline dari link */
        color: #007bff;
        /* Warna link */
        transition: color 0.3s;
        /* Efek transisi pada hover */
    }

    ul li a:hover {
        color: #0056b3;
        /* Mengubah warna saat hover */
    }

    /* Styling untuk tabel daftar file */
    table {
        width: 100%;
        /* Mengatur lebar tabel menjadi 100% dari kontainer */
        border-collapse: collapse;
        /* Menghapus jarak antara batas sel */
        margin-top: 20px;
        /* Margin atas untuk jarak dari elemen sebelumnya */
    }

    th,
    td {
        padding: 12px;
        /* Memberikan padding di dalam sel */
        text-align: left;
        /* Mengatur teks rata kiri */
        border-bottom: 1px solid #ddd;
        /* Garis bawah untuk batas sel */
    }

    th {
        background-color: #f2f2f2;
        /* Warna latar belakang untuk header tabel */
        font-weight: bold;
        /* Menebalkan teks header */
    }

    tr:hover {
        background-color: rgba(0, 115, 230, 0.1);
        /* Warna latar belakang saat hover pada baris */
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Logo Universitas Terbuka -->
        <img src="<?= base_url('images/ut_logo.png') ?>" alt="Logo Universitas Terbuka" class="logo">

        <!-- Welcome Text -->
        <div class="welcome-text">
            <h1>Selamat Datang Di File Manager Materi Pengayaan Universitas Terbuka</h1>
            <p>Silahkan memilih materi pengayaan berdasarkan fakultas atau gunakan fitur pencarian untuk memudahkan
                pencarian materi pengayaan.</p>
            <h2>Cara Mendownload:</h2>
            <ul>
                <li>Silahkan klik dua kali pada nama file untuk diarahkan ke halaman preview dan mengunduh materi
                    tersebut.</li>
            </ul>
        </div>

        <form action="<?= base_url('filemanager/search') ?>" method="get">
            <input type="text" name="query" placeholder="Cari materi atau fakultas..." required>
            <button type="submit">Cari</button>
        </form>



        <!-- Daftar Fakultas -->
        <!-- Daftar Fakultas -->
        <h2>Pilih Fakultas</h2>
        <ul class="faculty-list">
            <!-- Fakultas yang ditambahkan secara manual -->


            <!-- Fakultas yang diambil dari database -->
            <?php foreach ($faculties as $faculty): ?>
            <li>
                <a href="<?= site_url('/filemanager/faculty/' . $faculty['name']) ?>">
                    <!-- Periksa apakah ada 'icon' sebelum mencoba menampilkannya -->
                    <?php if (!empty($faculty['icon'])): ?>
                    <img src="<?= base_url('uploads/icons/' . $faculty['icon']) ?>" alt="<?= $faculty['name'] ?> Icon">
                    <?php else: ?>
                    <!-- Gambar default jika icon tidak ada -->
                    <img src="<?= base_url('uploads/icons/') ?>" alt=>
                    <?php endif; ?>
                    <?= $faculty['name'] ?>
                </a>
            </li>

            <?php endforeach; ?>
        </ul>

    </div>

</body>

</html>