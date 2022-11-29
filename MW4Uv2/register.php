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
    $username_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Please enter a username</span>';
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
    $username_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Username can only contain letters, numbers, and underscores!</span>';
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

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Please enter a password</span>';
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Password must have atleast 6 characters!</span>';
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Please confirm password</span>';
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = '<span style ="color:#f44242;text-align:left;font-size:15px">Password did not match</span>';
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

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Register Page</title>
  <link rel="stylesheet" type="text/css" href="CSS/Style.css">
  <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<style>
  body {
    font-family: "Lato", sans-serif
  }

  .mySlides {
    display: none
  }

  .container {
    position: relative;
    width: 100%;
  }

  .image {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 20px;
  }

  .overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    border-radius: 30px;

    opacity: 0;
    transition: .3s ease;
    background-color: #8d8d8d;
  }

  .container:hover .overlay {
    opacity: 1;
  }

  .text {
    color: #ffffff;
    font-size: 23px;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    text-align: center;
  }
</style>

<body>
  <nav class="navbar navbar-default">
    <a class="navbar-brand" href="index.php">
      <img src="Images/Logo.png" alt="logo" style="width:120px;">
    </a>
    <div class="container-fluid">
      <div class="navbar-header">
        <ul class="nav navbar-nav">
          <li><a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
          <li><a href="Products.html">Products</a></li>
          <li class="active"><a href="login.php">My Account</a></li>
          <li><a href="Contact Us.html">Contact Us</a></li>
          <li><a href="AboutUs.html">About Us</a></li>
        </ul>
        <form class="navbar-form navbar-left" action="/action_page.php">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
        </form>
      </div>
  </nav>
  <div class="title">
    <h1>Register</h1>
  </div>
  <div id="register">
    <div class="textinfo">
      <h3>Create a Free Account now!</h3>
      <br>
      <br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label>Username:<span>*</span></label><br>
        <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
        <span class="invalid-feedback"><?php echo $username_err; ?></span><br>
        <label>Password:<span>*</span></label><br>
        <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
        <span class="invalid-feedback"><?php echo $password_err; ?></span><br>
        <label>Confirm Password:<span>*</span></label><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span><br>
    </div>
    <div class="h-captcha" data-sitekey="667aee51-3796-4f0c-a600-8c4f4754745a" data-callback="verifyCaptcha" required></div>
    <div id="bot-verify"></div>

    <div class="buttons">
      <button class="register-buttonv2">Register</button><br>
      <p3>Already a User?</p3><br>
      <button onclick="location.href='login.php'" class="login-buttonv2" type="button">Login</button>
    </div>
    </form>

    <script src='https://www.hCaptcha.com/1/api.js'></script>
    <script>
      var sec = '';

      function validate() {

        if (sec.length == 0) {
          document.getElementById('bot-verify');
          alert("Please perform the capachia!")
          return false;
        }
        alert("Success!")
        return true;
      }

      function verifyCaptcha(token) {
        sec = token;
        document.getElementById('bot-verify');
      }
    </script>

  </div>
  </script>
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