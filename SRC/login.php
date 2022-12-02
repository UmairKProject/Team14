<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Enter a username!</span>';
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Enter a password!</span>';
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT customerID, customerUsername, customerPassword FROM customers WHERE customerUsername = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            // Redirect user to welcome page
                            header("location: user.php?id=$id");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            if ($_POST['username'] != "" || $_POST['password'] != "") {
                $usernames = $_POST['username'];
                // md5 encruption
                $passwords = md5($_POST['password']);
                //$password = $_POST['password'];
                //Sql statements
                $sqls = "SELECT * FROM `customers` WHERE `customerUsername`=? AND `customerPassword`=? ";
                $query = $link->prepare($sqls);
                $query->execute(array($usernames, $passwords));
                $row = $query->num_rows;
                $fetch = $query->fetch();
                if ($row > 0) {
                    $_SESSION['username'] = $fetch['customerID'];
                    //echo "<script>alert('That was successfull!')</script> <script>window.location = '#'</script>";
                } else {
                    //Username or password doesn't exist, dispaly a generic error
                    $login_err = "Invalid Username or Password";
                    //echo "<script>alert('Invalid Username or Password')</script><script>window.location = 'login.php'</script>";
                }
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Page title with other essential links to support CSS and Bootstrap elemts used in the website -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/scrolltopcontrol.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Login Page</title>
</head>

<!--Css font-style for the body-->
<style>
    body {
        font-family: "Lato", sans-serif
    }
</style>

<body>
    <!-- navbar for site -->
    <header><?php include 'header.php'; ?></header>

    <div class="title">
        <h1>Login</h1>
        <div id="login">
            <div class="textinfo">
                <h2>Welcome back!</h2>
                <!-- form to gather login details from user -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <label>Username</label><br>
                    <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span><br>
                    <label>Password</label><br>
                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span><br>
            </div>
            <div class="h-captcha" data-sitekey="667aee51-3796-4f0c-a600-8c4f4754745a" required></div>
            <!--data-callback="verifyCaptcha"-->
            <div id="bot-verify"></div>
            <!-- buttons to login or register -->
            <div class="buttons">
                <button class="login-button">Login</button><br>
                <p3>or</p3><br>
                <button onclick="location.href='register.php?page=account'" class="register-button" type="button">Register</button>
            </div>
            </form>
            <!-- scripts used to allow for captcha verification -->
            <script src='https://www.hCaptcha.com/1/api.js'></script>
            <script>
                var sec = '';

                function validate() {
                    if (sec.length == 0) {
                        document.getElementById('bot-verify');
                        alert("Please perform the capachia!")
                        return false;
                    }
                    return true;
                }

                function verifyCaptcha(token) {
                    sec = token;
                    document.getElementById('bot-verify');
                }
            </script>
            </form>
        </div>
        </script>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- footer for the site -->
        <footer><?php include 'footer.php'; ?></footer>
</body>

</html>