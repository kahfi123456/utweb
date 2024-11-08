<h2>Fakultas: <?= esc($faculty) ?></h2>
<h3>Jurusan: <?= esc($course) ?></h3>

<ul>
    <?php if (!empty($files)): ?>
    <?php foreach ($files as $file): ?>
    <li><a href="<?= site_url("filemanager/download/{$file['id']}") ?>"><?= esc($file['file_name']) ?></a></li>
    <?php endforeach; ?>
    <?php else: ?>
    <p>Tidak ada file ditemukan untuk jurusan ini.</p>
    <?php endif; ?>
</ul>