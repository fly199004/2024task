<?php
$env = parse_ini_file(__DIR__ . '/../.env');


if ($env === false) {
    die("Failed to load .env file. Check the path and permissions.");
}

$host = $env["host"];
$username = $env["username"];
$password = $env["password"];
$database =  $env["database"];

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
