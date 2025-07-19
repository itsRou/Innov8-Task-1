<?php
$host = 'localhost';
$db = 'innov8 tasks';
$user = "root";
$password = '';

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Successfully connected to the database<br>";
}

class User {
    public $name;
    public $email;
    private $password;
    private $confirmPassword;
    public $gender;
    public $hobbies;
    public $country;
   
   
    public $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function DataSetter($data) {
        $this->name = $data['Name'];
        $this->email = $data['Email'];
        $this->password = $data['Password'];
        $this->confirmPassword = $data['Confirm_Password'];
        $this->gender = $data['gender'];
        $this->hobbies = implode(",", $data['hobbies']);
        $this->country = $data['country'];
    }

    public function checkPassword() {
        return $this->password === $this->confirmPassword;
    }

    public function RepeatedEmail() {
        $query = "SELECT * FROM userinfo WHERE Email = '$this->email'";
        $result = $this->conn->query($query);
        return $result->num_rows > 0;
    }

    public function confirmming() {
        if (!$this->checkPassword()) {
            echo "Passwords do not match.";
            return;
        }

        if ($this->RepeatedEmail()) {
            echo "Email already exists.";
            return;
        }

        $hashed = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO userinfo (Name, Email, Password, Gender, Hobbies, Country) 
                  VALUES ('$this->name', '$this->email', '$hashed', '$this->gender', '$this->hobbies', '$this->country')";

        if ($this->conn->query($query)) {
            echo "Registered successfully <br>";
            $this->Preview();
        } else {
            echo "Registration failed.";
        }
    }

    public function Preview() {
        echo "<p><strong>Name:</strong> {$this->name}</p>";
        echo "<p><strong>Email:</strong> {$this->email}</p>";
        echo "<p><strong>Gender:</strong> {$this->gender}</p>";
        echo "<p><strong>Hobbies:</strong> {$this->hobbies}</p>";
        echo "<p><strong>Country:</strong> {$this->country}</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = new User($conn);
    $user->DataSetter($_POST);
    $user->confirmming();
    header("Location: signin.html");

} else {
    header("Location: Registeration.html");
    echo "Error";
}
?>