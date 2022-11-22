        <?php
        // Include config file
        require_once "config.php";

        // Define variables and initialize with empty values
        $username = $password = $confirm_password = "";
        $username_err = $password_err = $confirm_password_err = "";

        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

          // Validate username
          if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
          } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $username_err = "Username can only contain letters, numbers, and underscores.";
          } else {
            // Prepare a select statement
            $sql = "SELECT customerID FROM customers WHERE customerUsername = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "s", $param_username);

              // Set parameters
              $param_username = trim($_POST["username"]);

              // Attempt to execute the prepared statement
              if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                  $username_err = "This username is already taken.";
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

          // Validate password
          if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
          } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
          } else {
            $password = trim($_POST["password"]);
          }

          // Validate confirm password
          if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
          } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
              $confirm_password_err = "Password did not match.";
            }
          }

          // Check input errors before inserting in database
          if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

            // Prepare an insert statement
            $sql = "INSERT INTO customers (customerUsername, customerPassword) VALUES (?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
              // Bind variables to the prepared statement as parameters
              $bp = mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

              // Set parameters
              $param_username = $username;
              $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

              // Attempt to execute the prepared statement
              if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
              } else {
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
          <title>My Account</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <a class="navbar-brand" href="Index.html">
              <img src="Images/Logo.png" alt="logo" style="width:120px;">
            </a>
            <div class="container-fluid">
              <div class="navbar-header">

                <ul class="nav navbar-nav">
                  <li><a href="Index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
                  <li><a href="Products.html">Products</a></li>
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

          <div class="wrapper">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
              </div>
              <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
          </div>


          <footer class="w3-container w3-padding-64 w3-center w3-light-grey w3-xlarge">
            <p>Follow us on social media</p>
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
            <p class="w3-smal"></p> 2022-2023</p>
            <p class="w3-medium">Designed By: <a href="Index.html" target="_blank">Team Number 14</a></p>
          </footer>

        </body>

        </html>
