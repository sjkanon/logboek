<?php
require_once "config.php";

$sql = "SELECT id, username, email, role FROM users";
$result = mysqli_query($link, $sql);
?>

<!-- Display user list -->
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="edit-user.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete-user.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="add-user.php">Add New User</a>
<?php
mysqli_close($link);
?>