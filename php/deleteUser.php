<?php
//$data = $_POST;
//$user_id = (int) $data['user_id'];
//$firstName = (int) $data['f_name'];
//$lastName = (int) $data['l_name'];
//try{
//
//    $command="DELETE FROM users WHERE id={$user_id}";
//
//    include("config.php");
//    include("connection.php");
//
//    $conn->exec($command);
//    return json_encode([
//        "success" => true,
//        "message" => $firstName." ".$lastName." has been deleted."
//    ]);
//
//} catch (PDOException $e){
//    return json_encode([
//        "success" => false,
//        "message" => "Error"
//    ]);
//}
//
//
//

//$data = $_POST;
//
//// Ensure inputs are sanitised and validated
//$user_id = (int)$data['user_id'];
//$firstName = htmlspecialchars($data['f_name']);
//$lastName = htmlspecialchars($data['l_name']);
//
//try {
//    // Include database configuration and connection
//    include("config.php");
//    include("connection.php");
//
//    // Prepare and execute the DELETE query
//    $command = $conn->prepare("DELETE FROM users WHERE id = :user_id");
//    $command->bindParam(':user_id', $user_id, PDO::PARAM_INT);
//    $command->execute();
//
//    // Check if rows were affected
//    if ($command->rowCount() > 0) {
//        echo json_encode([
//            "success" => true,
//            "message" => "{$firstName} {$lastName} has been deleted."
//        ]);
//    } else {
//        echo json_encode([
//            "success" => false,
//            "message" => "User not found or already deleted."
//        ]);
//    }
//} catch (PDOException $e) {
//    // Return error message on exception
//    echo json_encode([
//        "success" => false,
//        "message" => "Error: " . $e->getMessage()
//    ]);
//}
//
//
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//header('Content-Type: application/json');
//try {
//    $data = $_POST;
//    $user_id = (int)$data['user_id'];
//    $firstName = $data['f_name'];
//    $lastName = $data['l_name'];
//
//    include("config.php");
//    include("connection.php");
//
//    $command = "DELETE FROM users WHERE id = :id";
//    $stmt = $conn->prepare($command);
//    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
//
//    $stmt->execute();
//
//    echo json_encode([
//        "success" => true,
//        "message" => "$firstName $lastName has been deleted."
//    ]);
//} catch (PDOException $e) {
//    error_log("Database Error: " . $e->getMessage());
//    echo json_encode([
//        "success" => false,
//        "message" => "Error deleting user: " . $e->getMessage()
//    ]);
//}


//header('Content-Type: application/json');
//
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//
//try {
//    include("config.php");
//    include("connection.php");
//
//    $data = $_POST;
//    if (!isset($data['user_id']) || !is_numeric($data['user_id'])) {
//        echo json_encode([
//            "success" => false,
//            "message" => "Invalid user ID."
//        ]);
//        exit;
//    }
//
//    $user_id = (int)$data['user_id'];
//
//    $command = "DELETE FROM users WHERE id = :id";
//    $stmt = $conn->prepare($command);
//
//    if (!$stmt) {
//        echo json_encode([
//            "success" => false,
//            "message" => "Failed to prepare statement: "
//        ]);
//        exit;
//    }
//
////    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
//    $stmt->execute();
//
//    echo json_encode([
//        "success" => true,
//        "message" => "User has been deleted successfully."
//    ]);
//} catch (PDOException $e) {
//    echo json_encode([
//        "success" => false,
//        "message" => "Error deleting user: " . $e->getMessage()
//    ]);
//}


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
