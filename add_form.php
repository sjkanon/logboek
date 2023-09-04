<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | EventSystem</title>
    <link rel="stylesheet" media="screen" href="../styles/stylesheet.css" />
    <link rel="stylesheet" media="screen" href="../styles/styles.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Add Data to logboek</h1>

        <form method="post" action="add.php">
            <div class="form-group">
                <label for="add_wie" size="50">Categorie</label>
                <input type="text" id="add_wie" name="add_wie" required>
            </div>
            
            <div class="form-group">
                <label for="add_wat">Wat</label>
                <select id="add_wat" name="add_wat" required>
                    <option value="Gestrand">Gestrand</option>
                    <option value="omgeslagen">Omgeslagen</option>
                    <option value="Overig">Overig</option>
                    <!-- Add more options as needed -->
                </select>
                </div>
                <div class="form-group">
                    <label for="add_waar">Locatie</label>
                    <input type="text" id="add_waar" name="add_waar" required>
                </div>
                <div class="form-group">
    <label for="add_message">Bericht</label>
    <textarea rows="8" id="add_message" name="add_message" required></textarea>
</div>
<div class="form-group">
                <label for="add_status">Status</label>
                <select id="add_status" name="add_status" required>
                    <option value="In Behandeling">In Behandeling</option>
                    <option value="Opgelost">Opgelost</option>
                    <option value="Actie vereist">Actie Vereist</option>
                    <!-- Add more options as needed -->
                </select>
                </div>

                <div class="form-group">
    <label for="add_statusmessage">Status Bericht</label>
    <textarea rows="8" id="addstatus_message" name="addstatus_message" required></textarea>
</div>
            <button type="submit">Add Log</button>
        </form>

        <div class="back-button">
            <a href="user_management.php">Back to log list</a>
        </div>
    </div>
</body>
</html>