<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $wie = $_POST["add_wie"];
    $wat = $_POST["add_wat"];
    $waar = $_POST["add_waar"];
    $message = $_POST["add_message"];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $insert_sql = $conn->prepare("INSERT INTO user_data (wie, wat, waar, message) VALUES (?, ?, ?, ?)");

    if ($insert_sql) {
        // Bind parameters to the prepared statement
        $insert_sql->bind_param("ssss", $wie, $wat, $waar, $message);

        // Execute the statement
        if ($insert_sql->execute()) {
            echo "Data added successfully!";
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
