<?php
// Establish a database connection
$host = 'localhost';
$db = 'innov8 tasks';
$user = "root";
$password = '';

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle signup request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST['Email'];
    $pass = $_POST['Password'];

    $sql="SELECT * FROM userinfo WHERE Email='$email'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0);
    $row=mysqli_fetch_array($result);
    if($row['Password']=$pass){
        header("location: users.php");
    }
}
    else{
        echo"error message";
    }



// Close the database connection
$conn->close();
?>