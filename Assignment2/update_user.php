<?php
require_once 'db_connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "User updated successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$conn->close();
?>