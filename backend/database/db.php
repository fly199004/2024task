<?php
$env = parse_ini_file('../.env');

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
