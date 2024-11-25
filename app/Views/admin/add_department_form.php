<style>
form {
    width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

select,
input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>

<form action="<?= site_url('/admin/addDepartment') ?>" method="post">
    <label for="faculty_id">Fakultas</label>
    <select name="faculty_id" id="faculty_id">
        <?php foreach ($faculties as $faculty): ?>
        <option value="<?php echo "$faculty[id]#$faculty[name]"; ?>"><?= $faculty['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="department_name">Nama Jurusan</label>
    <input type="text" name="department_name" id="department_name" required>

    <button type="submit">Tambah Jurusan</button>
    <a href="dashboard" class="button">Kembali ke Dashboard</a>
</form>