<form action="<?= site_url('/admin/add_department') ?>" method="post">
    <label for="faculty">Pilih Fakultas:</label>
    <select name="faculty_id">
        <?php foreach ($faculties as $faculty): ?>
        <option value="<?= $faculty['id'] ?>"><?= $faculty['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="department">Nama Jurusan:</label>
    <input type="text" name="department_name" required>

    <button type="submit">Tambah Jurusan</button>
</form>