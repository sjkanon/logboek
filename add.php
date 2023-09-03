<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $wie = $_POST["wie"];
    $wat = $_POST["wat"];
    $waar = $_POST["waar"];
    $message = $_POST["message"];

    // Insert data into the table
    $sql = "INSERT INTO logboek (wie, wat, waar, message) VALUES ('$wie', '$wat', '$waar', '$message')";

    if ($conn->query($sql) === TRUE) {
        header("Location: logboek.php"); // Redirect back to index page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
