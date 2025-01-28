<?php

header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    include("config.php"); // Configuration file (DB connection details)
    include("connection.php"); // Database connection file

    // Ensure the connection to the database is established
    if (!$conn) {
        echo json_encode([
            "success" => false,
            "message" => "Database connection failed."
        ]);
        exit;
    }

    $data = $_POST;

    // Validate and sanitize the user ID
    if (!isset($data['user_id']) || !is_numeric($data['user_id'])) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid user ID."
        ]);
        exit;
    }

    $user_id = (int)$data['user_id'];

$firstName = htmlspecialchars($data['f_name']);
$lastName = htmlspecialchars($data['l_name']);

    // Prepare the DELETE SQL query using mysqli
    $command = "DELETE FROM users WHERE id = $user_id";

    // Execute the query
    $result = mysqli_query($conn, $command);

    // Check if the query was successful
    if ($result) {
        echo json_encode([
            "success" => true,
            "message" => "User with name $firstName $lastName has been successfully deleted."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No user found with name $firstName $lastName or deletion failed."
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error deleting user: " . $e->getMessage()
    ]);
}
