<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - EventSystem</title>
    <link rel="stylesheet" media="screen" href="styles/stylesheet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- ... HTML content ... -->
</body>
</html>
