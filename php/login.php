<?php
session_start();
require_once('connection.php'); // Include your database connection

// Check if the user is already logged in, redirect to dashboard if true
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error_message ="";

// If parameters username and password not properly set, redirect to home page
if (!empty($_POST['username']) && !empty($_POST['password'])) {

    // A separate file to hide login details
    include 'connection.php';

    // username and password sent from form
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $query = "SELECT username 
            FROM users
            WHERE username = '$username' and password = '$password';";

    // Run Select SQL query
    $results = $conn->query($query);

    $count = $results->num_rows;

    // Close connection after executing the query
    $conn->close();

    // If result matched given username and password, there must be 1 row
    if ($count == 1) {
        $_SESSION["username"] = $username;

        header("location: dashboard.php");
        die();
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css"/>
    <script src="https://kit.fontawesome.com/04bda58819.js" crossorigin="anonymous"></script>
    <title>Catalyst Inventory</title>
</head>
<body id="loginBodyID">

<?php if (!empty($error_message)) { ?>
    <div id="errorMessageID" style="background-color: #ffe6e6; text-align: center;
            color: #ff0000; font-size: 20px; padding: 15px; border: 1px solid #ff0000;
            border-radius: 5px; ">

        <p><?= $error_message ?></p>
    </div>
<?php } ?>

<div class="container">
    <div class="loginHeader">
        <h1>Catalyst Inventory</h1>
        <p>Inventory Management Solution</p>
    </div>

    <div class="loginBody">

        <form action="login.php" method="POST">
            <div class="loginInputsContainer">
                <label for="username">Username</label>
                <input type="text" placeholder="username" name="username" required/>
            </div>
            <div class="loginInputsContainer">
                <label for="password">Password</label>
                <input type="password" placeholder="password" name="password" required/>
            </div>
            <div class="loginButtonContainer">
                <input id="submit" type="submit" value="Login">

            </div>
        </form>
    </div>

</div>


</body>
</html>


