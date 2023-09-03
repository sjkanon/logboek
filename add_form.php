<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Management - EventSystem</title>
    <link rel="stylesheet" media="screen" href="../styles/stylesheet.css" />
    <link rel="stylesheet" media="screen" href="../styles/styles.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JS (optional, but required for responsive features) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <h1>Add Data</h1>

    <form action="add.php" method="post">
        Wie: <input type="text" name="wie"><br>
        Wat: <input type="text" name="wat"><br>
        Waar: <input type="text" name="waar"><br>
        Message: <textarea name="message"></textarea><br>
        <input type="submit" value="Add">
    </form>

    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>