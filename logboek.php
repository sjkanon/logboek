<?php



?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP CRUD Example with MySQL</title>
</head>
<body>
    <h1>Simple PHP CRUD Example with MySQL</h1>

    <!-- Add Form -->
    <h2>Add Data</h2>
    <form action="add.php" method="post">
        Name: <input type="text" name="name"><br>
        Email: <input type="email" name="email"><br>
        <input type="submit" value="Add">
    </form>

    <!-- View/Search Form -->
    <h2>View/Search Data</h2>
    <form action="view.php" method="get">
        Search: <input type="text" name="search_query">
        <input type="submit" value="Search">
    </form>
</body>
</html>