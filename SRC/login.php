<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: User.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT customerID, customerUsername, customerPassword FROM customers WHERE customerUsername = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            // Redirect user to welcome page
                            header("location: User.php?id=$id");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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

        <head>
          <title>Login</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="icon" type="image/x-icon" href="./assets/logos/favicon.ico">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
          <style>
            body,
            html {
              font-family: "Lato", sans-serif;
              height: 100%;
              margin: 0;
            }

            .mySlides {
              display: none
            }

            .bg {
              /* The image used */
              background-image: url("images/Electric1.jpg");

              /* Full height */
              height: 100%;

              /* Center and scale the image nicely */
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
            }


            .column {
              float: left;
              width: 33.3%;
              margin-bottom: 16px;
              padding: 0 8px;
            }

            .card {
              box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            }

            .container {
              padding: 0 16px;
            }

            .container::after,
            .row::after {
              content: "";
              clear: both;
              display: table;
            }

            .title {
              color: grey;
            }


            .img-comp-container {
              position: relative;
              height: 200px;
              /*should be the same height as the images*/
            }
          </style>
          <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

          <script type="text/javascript" src="js/scrolltopcontrol.js">
            /***********************************************
             * Scroll To Top Control script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
             * Please keep this notice intact
             * Visit Project Page at http://www.dynamicdrive.com for full source code
             ***********************************************/
          </script>
        </head>

        <body>

          <nav class="navbar navbar-default">
            <a class="navbar-brand" href="Index.php">
              <img src="Images/Logo.png" alt="logo" style="width:120px;">
            </a>
            <div class="container-fluid">
              <div class="navbar-header">

                <ul class="nav navbar-nav">
                  <li><a href="Index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
                  <li><a href="Products.php">Products</a></li>
                  <li><a href="New Arrivals.html">New Arrivals</a></li>
                  <li><a href="Gallery.html">Gallery</a></li>
                  <li class="active"><a href="My Account.php">My Account</a></li>
                  <li><a href="Contact Us.html">Contact Us</a></li>
                  <li><a href="About Us.html">About Us</a></li>
                </ul>
                <form class="navbar-form navbar-left" action="/action_page.php">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                  </div>
                </form>
              </div>
          </nav>
<body>
    <div class="login">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="My%20Account.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>
