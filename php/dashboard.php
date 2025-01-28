<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit();
}

require_once('connection.php'); // Include your database connection


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css"/>
    <script src="https://kit.fontawesome.com/04bda58819.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body id="dashboardBodyID">
<div id="dashboardContainer">

    <?php include("../partials/sidebar.php") ?>

    <div class="contentContainer" id="contentContainer">

        <?php include("../partials/topNav.php") ?>

        <div class="content">
            <div class="contentMain">

            </div>

        </div>

    </div>

</div>
<script src="/CatalystInventory/js/dashboard.js"></script>

</body>
</html>
