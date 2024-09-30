<?php
// Include the database connection file
include '../../database/db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input for username, email, and password
    $inputUsername = $_POST['username'];
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($inputPassword !== $confirmPassword) {
        echo json_encode(['error' => 'Passwords do not match.']);
        exit();
    }

    // Check if the username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $inputUsername, $inputEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['error' => 'Username or email already exists.']);
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);

    // Insert new user data into the users table
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $inputUsername, $inputEmail, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Account created successfully!']);
    } else {
        echo json_encode(['error' => 'Failed to create account.']);
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request method is not POST, display the form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account</title>
    </head>
    <body>
        <h2>Create New Account</h2>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br>

            <button type="submit">Create Account</button>
        </form>
    </body>
    </html>
    <?php
}

// Close the database connection
$conn->close();
?>