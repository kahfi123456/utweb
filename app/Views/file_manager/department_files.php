<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan: <?= esc($jurusan['name']) ?></title>
</head>

<body>
    <h1>Jurusan: <?= esc($jurusan['name']) ?></h1>

    <h2>File:</h2>
    <ul>
        <?php if ($files): ?>
        <?php foreach ($files as $file): ?>
        <li>
            <a href="<?= site_url('filemanager/download/' . $file['id']) ?>">
                <?= esc($file['filename']) ?>
            </a>
        </li>
        <?php endforeach; ?>
        <?php else: ?>
        <p>Tidak ada file ditemukan untuk jurusan ini.</p>
        <?php endif; ?>
    </ul>
</body>

</html>