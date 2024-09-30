<?php
// Include the database connection file
include '../../database/db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input for username and password
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Query the database to check if the user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($inputPassword, $user['password'])) {
            // Successful login
            echo json_encode(['success' => 'Login successful! Welcome, ' . $inputUsername]);
        } else {
            // Incorrect password
            echo json_encode(['error' => 'Invalid username or password.']);
        }
    } else {
        // User does not exist
        echo json_encode(['error' => 'User does not exist.']);
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request method is not POST, display the login form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <h2>User Login</h2>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="create.php">Register here</a></p>
    </body>
    </html>
    <?php
}

// Close the database connection
$conn->close();
?>