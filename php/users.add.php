<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");// Redirect to login if not logged in
    $_SESSION['table'] = "";
    $user = $_SESSION['username'];
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
    <link rel="stylesheet" type="text/css" href="../css/users.add.css"/>
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
                <div class="row">
                    <div class="column column-5">
                        <h1 class="section-header"><i class="fa fa-plus"></i>    Create User</h1>
                        <div id="userAddFormContainer">
                            <form action="addUser.php" method="POST"class="addForm" id="userAddForm">
                                <div class="addFormInputContainer">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="addFormInput" name="firstName" id="firstName" placeholder="First Name" required></input>
                                </div>
                                <div class="addFormInputContainer">
                                    <label for="lastName">Last Name</label>
                                    <input type="text"class="addFormInput" name="lastName" id="lastName" placeholder="Last Name" required></input>
                                </div>
                                <div class="addFormInputContainer">
                                    <label for="username">Username</label>
                                    <input type="text" class="addFormInput"name="username" id="username" placeholder="Username" required></input>
                                </div>
                                <div class="addFormInputContainer">
                                    <label for="email">Email</label>
                                    <input type="email"class="addFormInput" name="email" id="email" placeholder="Email" required></input>
                                </div>
                                <div class="addFormInputContainer">
                                    <label for="password">Password</label>
                                    <input type="password" class="addFormInput"name="password" id="password" placeholder="Password" required ></input>
                                </div>
                                <input type="hidden" name="table" value="users"/>
                                <button type="submit" id="submit" class="addBtn"><i class="fa-solid fa-plus"></i>Add User</button>
                            </form>
                            <?php
                            if (isset($_SESSION['response'])) {
                                $response_message = $_SESSION['response']['message'];
                                $is_success= $_SESSION['response']['success'];

                                ?>
                                <div class="responseMessage">
                                    <p class="responseMessage <?=$is_success ? 'responseMessage_success' : 'responseMessage_error'?>">
                                        <?=$response_message?>
                                    </p>
                                </div>
                                <?php unset($_SESSION['response']); } ?>
                        </div>
                    </div>
                    <div class="column column-7">
                        <h1 class="section-header"><i class="fa fa-list"></i>    List of Users</h1>
                        <div class="section_content">
                            <div class="usersList">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>hello</td>
                                            <td>name</td>
                                            <td>last</td>
                                            <td>email</td>
                                            <td>1132</td>
                                            <td>3830</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        </div>

    </div>

</div>
<script src="/CatalystInventory/js/dashboard.js"></script>

</body>
</html>
