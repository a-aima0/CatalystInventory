<?php
    session_start();

if (isset($_POST['username'])) {
    // Update the session variable with the new username
    $_SESSION['username'] = $_POST['username'];
} else {
    echo "Username not provided.";
}

//    var_dump($_SESSION);
    $table_name = $_SESSION['table'];
    $_SESSION['table'] = "users";

    if (empty($table_name)) {
        die("Error: Table name is not specified.");
    }

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
//    var_dump($password);
    $encrypted = password_hash($password, PASSWORD_DEFAULT);

    $command="INSERT INTO 
                $table_name (firstName, lastName, username, email, password, createdAt, updatedAt) 
                VALUES ('$firstName', '$lastName', '$userName', '$email', '$encrypted', NOW(), NOW())";

    include("config.php");
    include("connection.php");


if ($conn->query($command) === TRUE) {
    $response = [
        "success" => true,
        "message" => $firstName . " " . $lastName . " has been added to the system"
    ];
} else {
    // Capture and store the error message in the session
    $response = [
        "success" => false,
        "message" => "Error: " . $conn->error
    ];
}

$_SESSION["response"] = $response; // Store the response in the session
$conn->close(); // Close the connection
header("Location: usersAdd.php"); // Redirect to the form page
exit;
?>

