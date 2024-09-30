<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Set HTTP response code to 405 Method Not Allowed
    exit; // Exit the script
}
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// --------------------- DO NOT EDIT THIS PAGE. IT INITIALIZES THE DATABSE FROM SCRATCH -----------------------
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
require '../database/db.php';

// creates the database
$sqlCommands = file_get_contents('../database/init.sql');
$commands = explode(';', $sqlCommands);
foreach ($commands as $command) {
    $command = trim($command);
    if (!empty($command)) {
        if ($conn->query($command) === FALSE) {
            echo "Error: " . $conn->error;
        }
    }
}

// --------------------------------------------------------
// $sql = "SELECT fakename FROM deleteme";
// $result = $conn->query($sql);

// $name = [];
// if ($result) {
//     while ($row = $result->fetch_assoc()) {
//         $name[] = $row['fakename'];
//     }
// } else {
//     echo "Error: " . $conn->error;
// }

// echo json_encode(['name' => $name]);
