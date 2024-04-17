<?php

// Define the database connection parameters
$host = 'localhost';
$dbname = 'database';
$user = 'root';
$password = "";

// Create a new MySQLi instance
$mysqli = new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_error) {
    echo 'Connection failed: '. $mysqli->connect_error;
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert the user into the database
    $username = $_POST['Name'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $confirmPassword = $_POST['Confirm Password'];

    // Validate the input
    if ($password!== $confirmPassword) {
        echo 'The passwords do not match.';
        return;
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO users (Name, Email, Password) VALUES ('$username', '$email', '$password')";

    // Execute the statement
    if ($mysqli->query($sql)) {
        echo 'Registration successful.';
    } else {
        echo 'Error: '. $mysqli->error;
    }
}

// Close the MySQLi connection
$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form id="registrationForm" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required autocomplete="username">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required autocomplete="email">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Create a password" required autocomplete="new-password">

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>

        <input type="submit" value="Sign Up">
        <p id="errorMessage"></p>
    </form>

    <!-- Add Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add custom JS -->
    <script>
        // Handle form submission
        $('#registrationForm').submit(function(event) {
            event.preventDefault();

            // Validate the input
            var username = $('#username').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var confirmPassword = $('#confirmPassword').val();

            if (password!== confirmPassword) {
                $('#errorMessage').text('The passwords do not match.');
                return;
            }

            // Send an AJAX request to the PHP file with the form data
            $.ajax({
                url: 'signup.php',
                method: 'POST',
                data: {
                    username: username,
                    email: email,
                    password: password,
                    confirmPassword: confirmPassword
                },
                success: function(response) {
                    // Handle the response
                    if (response === 'Please fill in all fields.') {
                        $('#errorMessage').text(response);
                    } else {
                        // Redirect to the homepage
                        window.location.href = 'index.php';
                    }
                }
            });
        });
    </script>
</body>
</html>