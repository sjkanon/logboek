<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $wie = $_POST["wie"];
    $wat = $_POST["wat"];
    $waar = $_POST["waar"];
    $message = $_POST["message"];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the table
    $sql = "INSERT INTO user_data (wie, wat, waar, message) VALUES ('$wie', '$wat', '$waar', '$message')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect back to index page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
