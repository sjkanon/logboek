<?php
session_start();
require_once "config.php"; // Include config.php to establish the database connection


// Function to display user navigation based on session status and group type
function displayUserNavigation() {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        // Display user-specific navigation
        if ($_SESSION["grouptype"] === "admin") {
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="/admin/management.php">Admin Management</a>';
            echo '<ul class="submenu">';
            echo '<li class="nav-item"><a class="nav-link" href="/admin/user_management.php">User Management</a></li>';
            // Add more sub-menu items as needed
            echo '</ul>';
            echo '</li>';
            echo '<li class="nav-item"><a class="nav-link" href="uitgifte.php">Uitgifte</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="logboek.php">Logboek</a></li>';
        } elseif ($_SESSION["grouptype"] === "logboek") {
            echo '<li class="nav-item"><a class="nav-link" href="logboek.php">Logboek</a></li>';
        } elseif ($_SESSION["grouptype"] === "uitgifte") {
            echo '<li class="nav-item"><a class="nav-link" href="uitgifte.php">Uitgifte</a></li>';
        } elseif ($_SESSION["grouptype"] === "uluser") {
            echo '<li class="nav-item"><a class="nav-link" href="logboek.php">Logboek</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="uitgifte.php">Uitgifte</a></li>';
        }
        echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
    } else {
        // Display navigation for guests
        echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>';
    }
}

// Retrieve data from the "logboek" table
$sql = "SELECT * FROM logboek";

// Check if the connection is valid before querying
if ($conn) {
    $result = $conn->query($sql);

    // Rest of your code for displaying data

    $conn->close(); // Close the database connection when done
} else {
    echo "Database connection error.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - EventSystem</title>
    <link rel="stylesheet" media="screen" href="styles/stylesheet.css" />
    <link rel="stylesheet" media="screen" href="styles/styles.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS (optional, but required for responsive features) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">EventSystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php displayUserNavigation(); ?>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="add-user-button">
            <a href="add_form.php" class="btn">Add Data</a>
        </div>
        <!-- View/Search Form -->
        <h2>View/Search Data</h2>
        <form action="view.php" method="get">
            Search: <input type="text" name="search_query">
            <input type="submit" value="Search">
        </form>

        <!-- Display Data -->
        <h2>Stored Data</h2>
        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead><tr>';
            echo '<th>Wie</th>';
            echo '<th>Wat</th>';
            echo '<th>Waar</th>';
            echo '<th>Message</th>';
            echo '<th>Created</th>';
            echo '<th>Updated</th>';
            echo '</tr></thead><tbody>';
            
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["Wie"] . '</td>';
                echo '<td>' . $row["Wat"] . '</td>';
                echo '<td>' . $row["Waar"] . '</td>';
                echo '<td>' . $row["message"] . '</td>';
                echo '<td>' . $row["created"] . '</td>';
                echo '<td>' . $row["update_time"] . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo "No data available.";
        }
        ?>
    </div>
    <footer>
        <p>&copy; 2023 Sjoerd Kanon by AvhTech. All rights reserved.</p>
    </footer>
</body>
</html>