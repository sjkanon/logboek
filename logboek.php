<?php
session_start();


?>

<!doctype html>
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
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="welcome.php">Home</a>
                        </li>
                        <?php if ($_SESSION["grouptype"] === "admin") { ?>
                          <li class="nav-item">
                            <a class="nav-link" href="/admin/management.php">Admin Management</a>
                             <ul class="submenu">
                               <li class="nav-item">
                                   <a class="nav-link" href="/admin/user_management.php">User Management</a>
                               </li>
                        <!-- Add more sub-menu items as needed -->
                             </ul>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="uitgifte.php">Uitgifte</a>
                          </li>
                          <li class="nav-item">
                                <a class="nav-link" href="logboek.php">Logboek</a>
                          </li>
                        <?php } elseif ($_SESSION["grouptype"] === "logboek") { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logboek.php">Logboek</a>
                            </li>
                            <?php } elseif ($_SESSION["grouptype"] === "uitgifte") { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="uitgifte.php">Uitgifte</a>
                            </li>
                            <?php } elseif ($_SESSION["grouptype"] === "uluser") { ?>
                              <li class="nav-item">
                                <a class="nav-link" href="logboek.php">Logboek</a>
                            </li>
                              <li class="nav-item">
                                <a class="nav-link" href="uitgifte.php">Uitgifte</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
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
    </nav>
    </header>
    <div class="container">
    <!-- View/Search Form -->
    <h2>View/Search Data</h2>
    <form action="view.php" method="get">
        Search: <input type="text" name="search_query">
        <input type="submit" value="Search">
    </form>

    <!-- Display Data -->
    <h2>Stored Data</h2>
    <?php
    require_once "config.php";

    // Retrieve all data from the table
    $sql = "SELECT * FROM user_data";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Name: " . $row["name"] . ", Email: " . $row["email"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No data available.";
    }

    $conn->close();
    ?>
    </div>
    <footer>
    <p>&copy; 2023 Sjoerd Kanon by AvhTech. All rights reserved.</p>
</footer>
</body>
</html>