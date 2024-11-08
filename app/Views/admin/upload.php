<h1>Upload File ZIP</h1>

<?php if (session()->getFlashdata('message')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('message') ?>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger">
    <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<form action="<?= site_url('admin/uploadZip'); ?>" method="post" enctype="multipart/form-data">
    <label for="faculty">Pilih Fakultas:</label>
    <select name="faculty" id="faculty" required>
        <option value="Fakultas Ekonomi">Fakultas Ekonomi</option>
        <option value="Fakultas Ilmu Sosial dan Ilmu Politik">Fakultas Ilmu Sosial dan Ilmu Politik</option>
        <option value="Fakultas Keguruan dan Ilmu Pendidikan">Fakultas Keguruan dan Ilmu Pendidikan</option>
        <option value="Fakultas Sains dan Teknologi">Fakultas Sains dan Teknologi</option>
        <option value="Pascasarjana">Pascasarjana</option>
        <!-- Tambahkan fakultas lain sesuai kebutuhan -->
    </select>

    <label for="zip_file">Upload File ZIP:</label>
    <input type="file" name="zip_file" id="zip_file" accept=".zip" required>

    <button type="submit">Upload</button>
</form>