<?php
$host = "localhost";
$dbname = "0909task";
$username = "root";
$password = "123456";

try {
    // Create PDO database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if POST request is received
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get user input for username and password
        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Check if passwords match
        if ($inputPassword !== $confirmPassword) {
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
            echo "<script>window.location.href='create.html';</script>";
            exit();
        }

        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM login WHERE username = :username");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Username already exists. Please choose another username.');</script>";
            echo "<script>window.location.href='create.html';</script>";
            exit();
        }

        // Insert new user data
        $stmt = $pdo->prepare("INSERT INTO login (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->bindParam(':password', $inputPassword);
        $stmt->execute();

        echo "<script>alert('Account created successfully!');</script>";
        echo "<script>window.location.href='login.html';</script>";
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

