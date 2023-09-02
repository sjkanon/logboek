<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../config.php";

// Edit User Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_id"])) {
    $edit_id = $_POST["edit_id"];
    $new_username = $_POST["new_username"];
    $new_grouptype = $_POST["new_grouptype"];
    $new_password = $_POST["new_password"]; // Corrected variable name

    $update_sql = "UPDATE users_new SET username=?, grouptype=?, password=? WHERE id=?";
    $update_stmt = mysqli_prepare($link, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "sssi", $new_username, $new_grouptype, $new_password, $edit_id); // Corrected parameter order
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

// Add User Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_username"])) {
    $add_username = $_POST["add_username"];
    $add_password = $_POST["add_password"];
    $add_grouptype = $_POST["add_group"]; // Corrected variable name

    $insert_sql = "INSERT INTO users_new (username, grouptype, password) VALUES (?, ?, ?)";
    $insert_stmt = mysqli_prepare($link, $insert_sql);
    mysqli_stmt_bind_param($insert_stmt, "sss", $add_username, $add_grouptype, $add_password); // Corrected parameter order
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);
}

// Delete User Logic
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"];

    $delete_sql = "DELETE FROM users_new WHERE id=?";
    $delete_stmt = mysqli_prepare($link, $delete_sql);
    mysqli_stmt_bind_param($delete_stmt, "i", $delete_id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
}

// Fetch user data from the database
$sql = "SELECT id, username, password, grouptype FROM users_new"; // Corrected column name
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | EventSystem</title>
</head>
<body>
    <h1>User Management</h1>

    <!-- User List -->
    <h2>User List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Group Type</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>{$row['grouptype']}</td>"; // Corrected column name
            echo "<td><a href='?edit_id={$row['id']}'>Edit</a> | <a href='?delete_id={$row['id']}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Add User Form -->
    <h2>Add User</h2>
    <form method="post" action="">
        <label>Username: <input type="text" name="add_username" required></label><br>
        <label>Password: <input type="password" name="add_password" required></label><br> <!-- Changed to password input type -->
        <label>Group Type: <input type="text" name="add_group" required></label><br> <!-- Corrected variable name -->
        <input type="submit" value="Add User">
    </form>

    <!-- Edit User Form -->
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

        <h2>Edit User</h2>
        <form method="post" action="">
            <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
            <label>Username: <input type="text" name="new_username" value="<?php echo $edit_username; ?>" required></label><br>
            <label>Password: <input type="password" name="new_password" value="<?php echo $edit_password; ?>" required></label><br>
            <label>Group Type: <input type="text" name="new_grouptype" value="<?php echo $edit_grouptype; ?>" required></label><br> <!-- Corrected variable name -->
            <input type="submit" value="Save Changes">
        </form>
    <?php
    }
    ?>

    <?php
    mysqli_close($link);
    ?>
</body>
</html>
