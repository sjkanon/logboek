<?php
require_once "../config.php";

// Initialize variables
$edit_id = $edit_username = $edit_grouptype = $edit_password = "";

// Fetch user data if editing
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["edit_id"])) {
    $edit_id = $_GET["edit_id"];
    $edit_sql = "SELECT username, grouptype FROM users_new WHERE id=?";
    $edit_stmt = mysqli_prepare($conn, $edit_sql);
    mysqli_stmt_bind_param($edit_stmt, "i", $edit_id);
    mysqli_stmt_execute($edit_stmt);
    mysqli_stmt_bind_result($edit_stmt, $edit_username, $edit_grouptype);
    mysqli_stmt_fetch($edit_stmt);
    mysqli_stmt_close($edit_stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | EventSystem</title>
    <link rel="stylesheet" media="screen" href="../styles/stylesheet.css" />
    <link rel="stylesheet" media="screen" href="../styles/styles.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>

        <!-- Edit User Form -->
        <h2>Edit User</h2>
        <form method="post" action="">
            <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
            <div class="form-group">
                <label for="new_username">Username</label>
                <input type="text" id="new_username" name="new_username" value="<?php echo $edit_username; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_grouptype">Group Type</label>
                <select id="new_grouptype" name="new_grouptype">
                    <option value="admin" <?php if ($edit_grouptype === "admin") echo "selected"; ?>>Admin</option>
                    <option value="logboek" <?php if ($edit_grouptype === "logboek") echo "selected"; ?>>Logboek</option>
                    <option value="uitgifte" <?php if ($edit_grouptype === "uitgifte") echo "selected"; ?>>Uitgifte</option>
                    <option value="uluser" <?php if ($edit_grouptype === "uluser") echo "selected"; ?>>Uitgifte en Logboek User</option>
                    <option value="uluser" <?php if ($edit_grouptype === "readonly") echo "selected"; ?>>Read Only User</option>
                </select>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" placeholder="Leave blank to keep current password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save Changes">
            </div>
        </form>

        <div class="back-button">
            <a href="user_management.php" class="btn">Back to User List</a>
        </div>
    </div>
</body>
</html>
