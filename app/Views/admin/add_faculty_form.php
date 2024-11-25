<!-- app/Views/admin/add_faculty_form.php -->
<h2 style="text-align: center; font-family: Arial, sans-serif; margin-bottom: 20px;">Tambah Fakultas</h2>
<form action="<?= site_url('admin/addFaculty') ?>" method="post"
    style="max-width: 400px; margin: 0 auto; background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div style="margin-bottom: 15px;">
        <label for="name" style="display: block; font-size: 16px; margin-bottom: 5px;">Nama Fakultas</label>
        <input type="text" id="name" name="name" required
            style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <button type="submit"
        style="background-color: #007bff; color: #fff; padding: 10px 15px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; width: 100%;">Tambah
        Fakultas</button>
    <a href="dashboard" class="button">Kembali ke Dashboard</a>
</form>