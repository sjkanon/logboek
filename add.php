<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $add_wie = $_POST["add_wie"];
    $add_wat = $_POST["add_wat"];
    $add_waar = $_POST["add_waar"];
    $add_message = $_POST["add_message"];

    // Insert data into the table
    $insertsql = "INSERT INTO logboek (wie, wat, waar, message) VALUES (?, ?, ?)";
    $insert_stmt = mysqli_prepare($link, $insert_sql);
    mysqli_stmt_bind_param($insert_stmt, "sss", $add_wie, $add_wat, $add_waar, $add_message);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);
   // Redirect back to user list or do other actions
   header("Location: logboek.php");
   exit();
}

mysqli_close($link);
?>
