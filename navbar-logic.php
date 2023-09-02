<?php
// Array of navigation items based on user groups
$navItems = array(
    'logboek' => array(
        array('url' => 'home.php', 'label' => 'Home'),
        array('url' => 'logboek.php', 'label' => 'Logboek'),
        array('url' => 'settings.php', 'label' => 'Settings')
        array('url' => 'profile.php', 'label' => 'Profile'),
        array('url' => 'logout.php', 'label' => 'Logout'),
    ),
    'uitgifte' => array(
        array('url' => 'home.php', 'label' => 'Home'),
        array('url' => 'uitgifte.php', 'label' => 'Uitgifte'),
        array('url' => 'settings.php', 'label' => 'Settings')
        array('url' => 'profile.php', 'label' => 'Profile'),
        array('url' => 'logout.php', 'label' => 'Logout'),
    ),
    'uluser' => array(
        array('url' => 'home.php', 'label' => 'Home'),
        array('url' => 'logboek.php', 'label' => 'Logboek'),
        array('url' => 'uitgifte.php', 'label' => 'Uitgifte'),
        array('url' => 'settings.php', 'label' => 'Settings'),
        array('url' => 'logout.php', 'label' => 'Logout'),
    ),
    'admin' => array(
        array('url' => 'home.php', 'label' => 'Home'),
        array('url' => 'logboek.php', 'label' => 'Logboek'),
        array('url' => 'uitgifte.php', 'label' => 'Uitgifte'),
        array('url' => 'settings.php', 'label' => 'Settings')
        array('url' => 'dashboard.php', 'label' => 'Dashboard'),
        array('url' => 'manage.php', 'label' => 'Manage'),
        array('url' => 'logout.php', 'label' => 'Logout'),
    ),
    // Add more groups and items as needed
);

// Replace 'user_group' with the actual session key that stores the user's group
$_SESSION["loggedin"] = true;
$_SESSION["id"] = $id;
$_SESSION["username"] = $username;
$_SESSION["user_group"] = $userGroup;
?>

<ul class="navbar-nav">
    <?php foreach ($navItems[$userGroup] as $item): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $item['url']; ?>"><?php echo $item['label']; ?></a>
        </li>
    <?php endforeach; ?>
</ul>
