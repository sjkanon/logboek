<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | EventSystem</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom stylesheet -->
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["edit_id"])) {
            $edit_id = $_GET["edit_id"];
            $edit_sql = "SELECT id, username, password, grouptype FROM users_new WHERE id=?";
            $edit_stmt = mysqli_prepare($link, $edit_sql);
            mysqli_stmt_bind_param($edit_stmt, "i", $edit_id);
            mysqli_stmt_execute($edit_stmt);
            mysqli_stmt_bind_result($edit_stmt, $edit_id, $edit_username, $edit_password, $edit_grouptype);
            mysqli_stmt_fetch($edit_stmt);
            mysqli_stmt_close($edit_stmt);
            ?>

            <form method="post" action="edit_user_process.php">
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                <div class="form-group">
                    <label for="new_username">Username</label>
                    <input type="text" id="new_username" name="new_username" value="<?php echo $edit_username; ?>" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Password</label>
                    <input type="password" id="new_password" name="new_password" value="<?php echo $edit_password; ?>" required>
                </div>
                <div class="form-group">
                    <label for="new_grouptype">Group Type</label>
                    <select id="new_grouptype" name="new_grouptype" required>
                        <option value="Admin" <?php if ($edit_grouptype == 'Admin') echo 'selected'; ?>>Admin</option>
                        <option value="User" <?php if ($edit_grouptype == 'User') echo 'selected'; ?>>User</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <button type="submit" class="btn">Save Changes</button>
            </form>
        <?php
        }
        ?>

        <div class="back-button">
            <a href="management.php" class="btn">Back to User List</a>
        </div>
    </div>
</body>
</html>
