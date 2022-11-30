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
              header("location: User.php");
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


      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="CSS/Style.css">
  <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<!--Css font-style for the body-->
<style>
  body {
    font-family: "Lato", sans-serif
  }
</style>

<body>
  <!--Navigation bar code-->
  <nav class="navbar navbar-default">
    <a class="navbar-brand" href="index.php">
    </a>
    <div class="container-fluid">
      <a class="navbar-header" href="index.php">
        <!--Logo in top corener-->
        <img src="Images/Logo.png" alt="logo" style="width: 80px;">
      </a>
      <!--navgation titles-->
      <ul class="nav navbar-nav">
        <!--Home-->
        <li><a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
        <!--Products-->
        <li><a href="Products.html">Products</a></li>
        <!--My Account-->
        <li class="active"><a href="login.php">My Account</a></li>
        <!--Contact Us-->
        <li><a href="ContactUs.html">Contact Us</a></li>
        <!--About Us-->
        <li><a href="AboutUs.html">About Us</a></li>
      </ul>
      <!--Search Bar-->
      <form class="navbar-form navbar-left" action="/action_page.php">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
      </form>
    </div>
  </nav>
  <div class="title">
    <h1>Login</h1>
  </div>
  <!--Login Page contents-->
  <div id="login">
    <div class="textinfo">
      <!--Header-->
      <h2>Welcome back!</h2><br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!--Username-->
        <label>Username:</label><br>
        <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
        <span class="invalid-feedback"><?php echo $username_err; ?></span><br>
        <!--Password-->
        <label>Password:</label><br>
        <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
        <span class="invalid-feedback"><?php echo $password_err; ?></span><br>

        <!--h-capacha code below with stie key-->
        <!--Reference for code used: https://docs.hcaptcha.com/switch/-->
        <div class="h-captcha" data-sitekey="667aee51-3796-4f0c-a600-8c4f4754745a" data-callback="verifyCaptcha" required></div>
        <div id="bot-verify"></div>

        <!--Login Button-->
        <div class="buttons">
          <button class="login-button">Login</button><br>
          <p3>or</p3><br>
          <button onclick="location.href='register.php'" class="register-button" type="button">Register</button>
        </div>
      </form>
    </div>

    <!--Validation for h-capcha-->
    <script src='https://www.hCaptcha.com/1/api.js'></script>
    <script>
      var sec = '';

      //validate function
      function validate() {

        //if the length is equal to 0, then produce an alert, else, return true
        if (sec.length == 0) {
          document.getElementById('bot-verify');
          alert("Please perform the capachia!")
          return false;
        }
        alert("Success!")
        return true;
      }

      //verifyCapcha function 
      function verifyCaptcha(token) {
        sec = token;
        document.getElementById('bot-verify');
      }
    </script>
  </div>

  <!--Footer contents-->
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