<?php
require_once "../config.php";
session_start();
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
    <link rel="stylesheet" media="screen" href="../styles/stylesheet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">EventSystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../welcome.php">Home</a>
                        </li>
                        <?php if ($_SESSION["grouptype"] === "admin") { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/management.php">Admin Management</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../uitgifte.php">Uitgifte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../logboek.php">Logboek</a>
                            </li>
                        <?php } elseif ($_SESSION["grouptype"] === "logboek") { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../logboek.php">Logboek</a>
                            </li>
                            <?php } elseif ($_SESSION["grouptype"] === "uitgifte") { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../uitgifte.php">Uitgifte</a>
                            </li>
                            <?php } elseif ($_SESSION["../grouptype"] === "uluser") { ?>
                              <li class="nav-item">
                                <a class="nav-link" href="logboek.php">Logboek</a>
                            </li>
                              <li class="nav-item">
                                <a class="nav-link" href="../uitgifte.php">Uitgifte</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    </header>
    <footer>
    <p>&copy; 2023 Sjoerd Kanon by AvhTech. All rights reserved.</p>
</footer>
</body>
</html>
