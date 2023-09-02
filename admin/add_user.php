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
        <label>Password: <input type="email" name="new_password" value="<?php echo $edit_password; ?>" required></label><br>
        <label>Group Type: 
            <select name="new_grouptype">
                <option value="admin" <?php if ($edit_grouptype === "admin") echo "selected"; ?>>Admin</option>
                <option value="logboek" <?php if ($edit_grouptype === "logboek") echo "selected"; ?>>Logboek</option>
                <option value="uitgifte" <?php if ($edit_grouptype === "uitgifte") echo "selected"; ?>>Uitgifte</option>
                <option value="uluser" <?php if ($edit_grouptype === "uluser") echo "selected"; ?>>UL User</option>
            </select>
        </label><br>
        <input type="submit" value="Save Changes">
    </form>
?>