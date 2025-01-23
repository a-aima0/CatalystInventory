<?php

//?>

<?php
include("connection.php");

$query = "SELECT * FROM users ORDER BY createdAt DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result(); // Get the result set

$users = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
$stmt->close();
$conn->close();

return $users;
?>
