<!-- Add User Form -->
<h2>Add User</h2>
<form method="post" action="">
    <label>Username: <input type="text" name="add_username" required></label><br>
    <label>Password: <input type="password" name="add_password" required></label><br>
    <label>Group Type:
        <select name="add_grouptype" required>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            <!-- Add more options as needed -->
        </select>
    </label><br>
    <input type="submit" value="Add User">
</form>