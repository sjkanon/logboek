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
if (isset($_GET['filter_wie']) && $_GET['filter_wie'] !== '') {
    $filter_wie = $_GET['filter_wie'];
    $sql .= " AND Wie LIKE '%$filter_wie%'";
}
if (isset($_GET['filter_wie']) && $_GET['filter_wie'] !== '') {
    $filter_wie = $_GET['filter_wie'];
    $sql .= " AND Wat LIKE '%$filter_wie%'";
}
if (isset($_GET['filter_wie']) && $_GET['filter_wie'] !== '') {
    $filter_wie = $_GET['filter_wie'];
    $sql .= " AND Waar LIKE '%$filter_wie%'";
}
// Similar filter conditions for other columns

// Sorting
$sort_columns = array("wie", "wat", "waar", "message", "created", "update_time");
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
        <!-- View/Search Form -->
<form method="GET">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="filter_wie">Filter Wie:</label>
            <input type="text" id="filter_wie" name="filter_wie" class="form-control" value="<?php echo isset($_GET['filter_wie']) ? $_GET['filter_wie'] : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="filter_wat">Filter Wat:</label>
            <input type="text" id="filter_wat" name="filter_wat" class="form-control" value="<?php echo isset($_GET['filter_wat']) ? $_GET['filter_wat'] : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="filter_waar">Filter Waar:</label>
            <input type="text" id="filter_waar" name="filter_waar" class="form-control" value="<?php echo isset($_GET['filter_waar']) ? $_GET['filter_waar'] : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="filter_message">Filter Message:</label>
            <input type="text" id="filter_message" name="filter_message" class="form-control" value="<?php echo isset($_GET['filter_message']) ? $_GET['filter_message'] : ''; ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="filter_created">Filter Created:</label>
            <input type="text" id="filter_created" name="filter_created" class="form-control" value="<?php echo isset($_GET['filter_created']) ? $_GET['filter_created'] : ''; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="filter_updated">Filter Updated:</label>
            <input type="text" id="filter_updated" name="filter_updated" class="form-control" value="<?php echo isset($_GET['filter_updated']) ? $_GET['filter_updated'] : ''; ?>">
        </div>
        <!-- Add more filter input fields for other columns if needed -->
    </div>
    <button type="submit" class="btn btn-primary">Apply Filters</button>
</form>
        <!-- Display Data -->
        <h2>Stored Data</h2>
        <table class="table">
            <thead>
                <tr>
                    <th><a href="?sort=wie_asc">Wie &#9650;</a></th>
                    <th><a href="?sort=wat_asc">Wat &#9650;</a></th>
                    <th><a href="?sort=waar_asc">Waar &#9650;</a></th>
                    <th><a href="?sort=message_asc">Message &#9650;</a></th>
                    <th><a href="?sort=created_asc">Created &#9650;</a></th>
                    <th><a href="?sort=update_time_asc">Updated &#9650;</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
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
                } else {
                    echo '<tr><td colspan="6">No data available.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2023 Sjoerd Kanon by AvhTech. All rights reserved.</p>
    </footer>
</body>
</html>
