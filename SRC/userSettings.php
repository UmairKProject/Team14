<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
    exit;
}

//Initialize empty variables
$username = $password = $confirmPassword = "";
$oldUsername = $oldPassword = "";
$confirm_password_err = $password_err = $username_err = "";

//Database connection file
require_once("config.php");

//If the form is submitted
if (isset($_POST['submit'])) {
    //Get user's id from the url
    $id = $_GET['id'];
    $query = "SELECT * FROM customers WHERE customerID = $id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    //Get old username and password
    $oldUsername = $row['customerUsername'];
    $oldPassword = $row['customerPassword'];

    //Remove whitespace from entries(using trim())
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    //If username is empty use the old username
    if (empty($username)) {
        $username = $oldUsername;
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $username_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Username can only contain letters, numbers, and underscores!</span>';
    } else {
        // Prepare a select statement
        $sql = "SELECT customerID FROM customers WHERE customerUsername = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = '<span style ="color:#f44242;text-align:left;font-size:15px">This username is already taken!</span>';
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    //If the password is empty use the old password
    if (empty($password)) {
        $password = $oldPassword;
    } elseif (strlen($password) < 6) {
        $password_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Password must have atleast 6 characters!</span>';
    }
    if ($password != $confirmPassword) {
        $confirm_password_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Password did not match</span>';
    }
    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $param_username = $username;
        //Hash the password before inserting into database
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        //Prepare sql statement
        $sql = "UPDATE customers SET customerUsername = '$param_username', customerPassword = '$param_password' WHERE customerID = $id;";
        $stmt = mysqli_prepare($link, $sql);
        //execute SQL statement and go back to dashboard if executed correctly
        if (mysqli_stmt_execute($stmt)) {
            header("location: adminDashboard.php");
        } else {
            echo "Unable to update customer records.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Page title with other essential links to support CSS and Bootstrap elements used in the website -->

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styling used for body and the form -->
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }

        #form {
            float: center;
            box-shadow: 50px 30px 20px rgb(255, 255, 255);
            margin: 25px auto;
            max-width: 370px;
            padding: 30px;
        }
    </style>
</head>

<body>
    <!-- navbar used acros all admin sites -->
    <?php include 'adminDashboardHeader.php'; ?>
    <br>
    <!-- welcome message -->
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <!-- form used to enter new details -->
    <div id="form">
        <form method="post">
            <!-- username entry -->
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter a new username">
                <span class="invalid-feedback"><?php echo $username_err; ?></span><br>
            </div>
            <!-- double validation password entry -->
            <!-- password entry -->
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter a new password">
                <span class="invalid-feedback"><?php echo $password_err; ?></span><br>
            </div>
            <!-- second password entry -->
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirmPassword" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="Confirm your password">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span><br>
            </div>
            <div class="form-group">
                <!-- submit button -->
                <input type="submit" name="submit" class="btn btn-primary" value="Update User Record" />
            </div>
        </form>
        <div>

</body>

</html>