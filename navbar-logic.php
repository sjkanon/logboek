<?php
// navbar_logic.php

// Retrieve the user's group from the session
$userGroup = isset($_SESSION["user_group"]) ? $_SESSION["user_group"] : "";

// Simulate user groups (you would fetch this information from a database)
$userGroups = [
    'admin' => ['Home','Logboek' ,'Uitgifte', 'Users', 'Settings'],
    'logboek' => ['Home', 'Logboek' ,'Profile', 'Settings'],
    'uitgifte' => ['Home', 'Uitgifte' ,'Profile', 'Settings']
];

// Determine which navbar items to display based on the user's group
$navbarItems = isset($userGroups[$userGroup]) ? $userGroups[$userGroup] : [];

// Loop through the navbar items and display them
foreach ($navbarItems as $item) {
    echo '<li><a href="#">' . $item . '</a></li>';
}
?>

