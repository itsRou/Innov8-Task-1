<?php
require_once 'Database.php';
require_once 'User.php';

$db = new Database();
$userObj = new User($db->connection);
$users = $userObj->getAllUsers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <h2>User List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th><th>Email</th><th>Gender</th><th>Hobbies</th><th>Country</th><th>Actions</th>
        </tr>
        <?php while($row = $users->fetch_assoc()): ?>
        <tr>
            <td><?= $row['Name'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['Gender'] ?></td>
            <td><?= $row['Hobbies'] ?></td>
            <td><?= $row['Country'] ?></td>
            <td><a href="edit.php?id=<?= $row['ID'] ?>">Edit</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
     <button type="button"  class="disable" >
                  <a href="signin.html" style="color: black ; "> Log Out </a>
                </button>
</body>
</html>