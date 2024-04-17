<?php
require_once 'db_connection.php';

$sql = "SELECT id, name, email, password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: ". $row["id"]. " - Name: ". $row["name"]. " - Email: ". $row["email"]. " - Password: ". $row["password"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>