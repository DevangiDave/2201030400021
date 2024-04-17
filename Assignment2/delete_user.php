<?php
require_once 'db_connection.php';

$id = $_POST['$name'];

$sql = "DELETE FROM users WHERE id=$name=''";

if ($conn->query($sql) === TRUE) {
    echo "User deleted successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$conn->close();
?>