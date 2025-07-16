<?php
$host = 'localhost';
$db = 'innov8 tasks';
$user = "root";
$Password = '';

$conn = new mysqli($host, $user, $Password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Successfully connected to the database<br>";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $gender = $_POST['gender'];
    $hobbies =$_POST['hobbies'];
    $hobbies_str = implode(",", $_POST['hobbies']);
    $country = $_POST['country'];



if ($Password !== $_POST['Confirm_Password']) {  
        echo "Passwords do not match.";
        exit;
    }

    $checkQuery = "SELECT * FROM userinfo WHERE Email = '$Email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
            echo 'Email already exists';
        exit;
    }

    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO userinfo (Name, Email, Password, Gender, Hobbies, Country) VALUES ('$Name', '$Email', '$hashedPassword', '$gender', '$hobbies_str', '$country')";

    if ($conn->query($insertQuery) === true) {
        echo "Registered successful";
    echo "<p><strong>Name:</strong> $Name</p>";
    echo "<p><strong>Email:</strong> $Email</p>";
    echo "<p><strong>Gender:</strong> $gender</p>";
    echo "<p><strong>Hobbies:</strong> $hobbies_str</p>";
    echo "<p><strong>Country:</strong> $country</p>";
}
    } else {
        header("location:./Registeration.html");
        echo ("Error");
    }

?>