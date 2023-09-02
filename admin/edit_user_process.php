<?php
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_id"])) {
    $edit_id = $_POST["edit_id"];
    $new_username = $_POST["new_username"];
    $new_grouptype = $_POST["new_grouptype"];
    $new_password = $_POST["new_password"];

    $update_sql = "UPDATE users_new SET username=?, grouptype=?, password=? WHERE id=?";
    $update_stmt = mysqli_prepare($link, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "sssi", $new_username, $new_grouptype, $new_password, $edit_id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);

    // Redirect back to user list and edit page
    header("Location: user_management.php");
    exit();
}

mysqli_close($link);
?>
