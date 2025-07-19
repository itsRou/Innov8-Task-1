<?php
require_once 'Database.php';
require_once 'User.php';

$db = new Database();
$userObj = new User($db->connection);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userData = $userObj->getUserById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userObj->updateUser($_POST, $_POST['id']);
    header("Location: users.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $userData['ID'] ?>">

        <label>Name:</label>
        <input type="text" name="Name" value="<?= $userData['Name'] ?>" required><br><br>

        <label>Email:</label>
        <input type="email" name="Email" value="<?= $userData['Email'] ?>" required><br><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" <?= $userData['Gender'] === 'Male' ? 'checked' : '' ?>> Male
        <input type="radio" name="gender" value="Female" <?= $userData['Gender'] === 'Female' ? 'checked' : '' ?>> Female<br><br>

        <label>Hobbies:</label><br>

        <?php
        $allHobbies = ['Reading', 'Gaming', 'Sports'];
        $savedHobbies = explode(",", $userData['Hobbies']);
        foreach ($allHobbies as $hobby) {
            $checked = in_array($hobby, $savedHobbies) ? 'checked' : '';
            echo "<input type='checkbox' name='hobbies[]' value='$hobby' $checked> $hobby ";
        }
        ?>
        <br><br>
        

        <label>Country:</label>
        <select name="country" required>
            <option value="">Select</option>
            <?php
            $countries = ['Egypt', 'USA', 'China', 'Spain'];
            foreach ($countries as $c) {
                $selected = $userData['Country'] === $c ? 'selected' : '';
                echo "<option value='$c' $selected>$c</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>

