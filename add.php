<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";
session_start();
$gebruiker = $_SESSION["username"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $wie = $_POST["add_wie"];
    $wat = $_POST["add_wat"];
    $waar = $_POST["add_waar"];
    $message = $_POST["add_message"];
    
    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $insert_sql = $conn->prepare("INSERT INTO logboek (wie, wat, waar, message, gebruiker) VALUES (?, ?, ?, ?, ?)");

    if ($insert_sql) {
        // Bind parameters to the prepared statement
        $insert_sql->bind_param("sssss", $wie, $wat, $waar, $message, $gebruiker);

        // Execute the statement
        if ($insert_sql->execute()) {
            echo "Data added successfully!";
            header("Location: logboek.php");
        } else {
            echo "Error: " . $insert_sql->error;
        }

        // Close the statement
        $insert_sql->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
