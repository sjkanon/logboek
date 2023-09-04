<?php
session_start();
require_once "config.php"; // Include config.php to establish the database connection

// Function to display user navigation based on session status and group type
function displayUserNavigation() {
    // ... (unchanged)
}

// Retrieve data from the "logboek" table
$sql = "SELECT * FROM logboek WHERE 1";

// Filter criteria
$filters = array("gebruiker","created", "Wie", "Wat", "Waar");
foreach ($filters as $filter) {
    if (isset($_GET["filter_$filter"]) && $_GET["filter_$filter"] !== '') {
        $filter_value = $_GET["filter_$filter"];
        $sql .= " AND $filter LIKE '%$filter_value%'";
    }
}

// Sorting
$sort_columns = array("gebruiker","created", "Wie", "Wat", "Waar", "message", "updated_time");
$sort_order = isset($_GET['sort']) ? $_GET['sort'] : '';

if ($sort_order) {
    list($sort_column, $sort_direction) = explode('_', $sort_order);
    
    if (in_array($sort_column, $sort_columns)) {
        $sql .= " ORDER BY $sort_column";
        if ($sort_direction === 'asc' || $sort_direction === 'desc') {
            $sql .= " $sort_direction";
        }
    }
}

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
    <div class="container-full">
    <div class="row">
        <div class="col-md-6">
            <div class="add-user-button">
                <a href="add_form.php" class="btn btn-primary">Add Data</a>
            </div>
        </div>
        <div class="col-md-6">
            <!-- View/Search Form -->
            <div class="form-row">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filterCollapse">
                    Show Filters
                </button>
            </div>
            <div id="filterCollapse" class="collapse">
                <form method="GET">
                    <div class="form-row">
                        <?php foreach ($filters as $filter) { ?>
                            <div class="form-group col-md-3">
                                <label for="filter_<?php echo $filter; ?>">Filter <?php echo ucfirst($filter); ?>:</label>
                                <input type="text" id="filter_<?php echo $filter; ?>" name="filter_<?php echo $filter; ?>" class="form-control" value="<?php echo isset($_GET["filter_$filter"]) ? $_GET["filter_$filter"] : ''; ?>">
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </form>
            </div>
        </div>
    </div>
        <!-- Display Data -->
        <h2>Logboek Data</h2>
        <table class="table" style="table-layout: auto;">
    <thead>
        <tr>
            <th><a href="?sort=gebruiker_asc">Gebruiker &#9650;</a> <a href="?sort=gebruiker_desc">&#9660;</a></th>
            <th><a href="?sort=created_asc">Created &#9650;</a> <a href="?sort=created_desc">&#9660;</a></th>
            <th><a href="?sort=wie_asc">Wie &#9650;</a> <a href="?sort=wie_desc">&#9660;</a></th>
            <th><a href="?sort=wat_asc">Wat &#9650;</a> <a href="?sort=wat_desc">&#9660;</a></th>
            <th><a href="?sort=waar_asc">Waar &#9650;</a> <a href="?sort=waar_desc">&#9660;</a></th>
            <th><a href="?sort=message_asc">Message &#9650;</a> <a href="?sort=message_desc">&#9660;</a></th>
            <th><a href="?sort=updated_asc">Updated &#9650;</a> <a href="?sort=updated_desc">&#9660;</a></th>
          
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                foreach ($sort_columns as $column) {
                    echo '<td>' . $row[$column] . '</td>';
                }
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="' . count($sort_columns) . '">No data available.</td></tr>';
        }
        ?>
    </tbody>
</table>


    </div>
    <?php include 'footer.html'; ?>   
   </body>
</html>
