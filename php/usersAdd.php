<?php

session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['table'] = "users"; // Assign table name for later use
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}
$user = $_SESSION['username'];
$users = include("showUsers.php");
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../css/usersAdd.css"/>
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
                                        <?= htmlspecialchars($response_message)?>
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
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $index => $user) { ?>
                                        <tr>
                                            <td><?= $index + 1?></td>
                                            <td><?= $user["username"] ?></td>
                                            <td><?= $user["firstName"] ?></td>
                                            <td><?= $user["lastName"] ?></td>
                                            <td><?= $user["email"] ?></td>
                                            <td><?= date("M d,Y : h:i:s A", strtotime($user["createdAt"]))?></td>
                                            <td><?= date("M d,Y : h:i:s A", strtotime($user["updatedAt"]))?></td>
                                            <td>
                                                <a href=""><i class="fa fa-pencil"></i>Edit</a>
                                                <a href="" class="deleteUser" data-userid="<?= $user["id"] ?>" data-fname="<?= $user["firstName"] ?>" data-lname="<?= $user["lastName"] ?>" ><i class="fa fa-trash"></i>Delete</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <p class="userCount"><?= count($users); ?> Users</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/usersAdd.js"></script>

</body>
</html>
