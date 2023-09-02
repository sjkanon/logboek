<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User | EventSystem</title>
</head>
<body>
    <div class="container">
        <h1>Add User</h1>

        <form method="post" action="add_user_process.php">
            <div class="form-group">
                <label for="add_username">Username</label>
                <input type="text" id="add_username" name="add_username" required>
            </div>
            <div class="form-group">
                <label for="add_password">Password</label>
                <input type="password" id="add_password" name="add_password" required>
            </div>
            <div class="form-group">
                <label for="add_grouptype">Group Type</label>
                <select id="add_grouptype" name="add_grouptype" required>
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <button type="submit">Add User</button>
        </form>

        <div class="back-button">
            <a href="user_management.php">Back to User List</a>
        </div>
    </div>
</body>
</html>
