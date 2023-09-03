<?php
// Database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'logboek');
define('DB_PASSWORD', 'uYf6d6~94');
define('DB_NAME', 'kanonict_logboek');

// Attempt to connect to MySQL database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("ERROR: Could not connect. " . $conn->connect_error);
}
?>
