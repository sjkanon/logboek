<?php
// Establish a database connection
// Include config file
require_once "config.php";

// Simulate the current user's group (you would retrieve this from your authentication system)
$userGroup = 'user'; // Change this based on your scenario

// Fetch navbar items based on the user's group from the database
$query = "SELECT navbar_items FROM user_groups WHERE group_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userGroup);
$stmt->execute();
$stmt->bind_result($navbarItems);
$stmt->fetch();

$stmt->close();
$conn->close();

// Convert the fetched navbar items to an array
$navbarItemsArray = explode(',', $navbarItems);

// Loop through the navbar items and display them
foreach ($navbarItemsArray as $item) {
    echo '<li><a href="#">' . $item . '</a></li>';
}
?>
