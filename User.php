
<?php
class User {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM userinfo";
        return $this->conn->query($query);
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM userinfo WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($data, $id) {
        $stmt = $this->conn->prepare("UPDATE userinfo SET Name=?, Email=?, Gender=?, Hobbies=?, Country=? WHERE ID=?");
        $hobbies = implode(",", $data['hobbies']);
        $stmt->bind_param("sssssi", $data['Name'], $data['Email'], $data['gender'], $hobbies, $data['country'], $id);
        return $stmt->execute();
    }
}
?>