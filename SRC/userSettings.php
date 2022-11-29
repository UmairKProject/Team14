<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
    exit;
}

$username = $password = $confirmPassword = "";

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="./assets/logos/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include 'adminDashboardHeader.php'; ?>
    <br>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>

    <form method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter a new username">
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="text" name="password" placeholder="Enter a new password">
        </div>
        <div class="form-group">
            <label>Confirm Password:</label>
            <input type="text" name="confirmPassword" placeholder="Confirm your password">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Update User Record" />
        </div>
    </form>

</body>

</html>