<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <style>
    /* Style umum */
    body {
        font-family: Arial, sans-serif;
        background-color: aqua;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 90%;
        max-width: 600px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
    }

    h2 {
        color: #333;
        font-size: 1.5em;
        margin-bottom: 20px;
    }

    .search-bar {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-bar-row {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .search-bar input[type="text"] {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
    }

    .search-bar select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
    }

    .search-bar button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #ffffff;
        cursor: pointer;
        transition: background-color 0.3s;
        font-weight: bold;
        width: 100px;
    }

    .search-bar button:hover {
        background-color: #0056b3;
    }

    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    li {
        background-color: #f9f9f9;
        margin: 10px 0;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    li a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        transition: color 0.3s;
    }

    li a:hover {
        color: #0056b3;
    }

    .back-link {
        display: block;
        margin-top: 20px;
        font-weight: bold;
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: #007bff;
    }
    </style>
</head>

<body>
    <div class="container">

        <h2>Hasil Pencarian untuk
            "<?= isset($query) ? esc($query) : '' ?>"<?= isset($department) ? ' di ' . esc($department) : '' ?></h2>

        <?php if (!empty($results)): ?>
        <ul>
            <?php foreach ($results as $file): ?>
            <li>
                <a href="<?= base_url($file['file_path']) ?>" download><?= esc($file['filename']) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>Tidak ada hasil ditemukan untuk
            "<?= isset($query) ? esc($query) : '' ?>"<?= isset($department) ? ' di ' . esc($department) : '' ?>.</p>
        <?php endif; ?>

        <a href="<?= site_url('/filemanager') ?>" class="back-link">Kembali ke Halaman Utama</a>
    </div>
</body>

</html>