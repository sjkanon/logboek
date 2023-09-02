<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - EventSystem</title>
    <link rel="stylesheet" media="screen" href="styles/stylesheet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>Add User</h1>

    <!-- Add User Form -->
    <form method="post" action="add_user_process.php">
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
</body>
</html>