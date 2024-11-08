<form action="<?= base_url('admin/addFacultyDepartment') ?>" method="post">
    <label for="faculty">Faculty:</label>
    <input type="text" name="faculty" id="faculty" required>

    <label for="department">Department:</label>
    <input type="text" name="department" id="department" required>

    <button type="submit">Add</button>
</form>