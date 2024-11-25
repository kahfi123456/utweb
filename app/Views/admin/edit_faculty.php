2. **Periksa Nama File**
Pastikan nama file tepat sesuai dengan yang dirujuk di controller (`edit_faculty.php`). Nama file harus sesuai, termasuk
huruf kecil/besar.

3. **Isi Dasar File View**
Untuk memastikan file dapat diakses, coba isi `edit_faculty.php` dengan konten sederhana, seperti:

```php
<h2>Edit Fakultas</h2>
<form action="/admin/edit-faculty/<?= $faculty['id'] ?>" method="post">
    <label for="name">Nama Fakultas:</label>
    <input type="text" id="name" name="name" value="<?= esc($faculty['name']) ?>">
    <button type="submit">Update</button>
</form>