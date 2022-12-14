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


<!DOCTYPE html>
<html lang="en">

<!-- Page title with other essential links to support CSS and Bootstrap elemts used in the website -->
<head>
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
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Register Page</title>
  <!--Css font-style for the body-->
  <style>
    body {
      font-family: "Lato", sans-serif
    }
  </style>
</head>


<body>
  <!-- navbar for the site -->
  <?php include 'header.php'; ?>
  
  <!-- register form -->
  <div class="title">
    <h1>Register</h1>
  </div>
  <div id="register">
    <div class="textinfo">
      <h3>Create a Free Account now!</h3>
      <!-- form that gets users credentials -->
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validate();">
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
      <button onclick="location.href='login.php?page=account'" class="login-buttonv2" type="button">Login</button>
    </div>
    </form>
    <!-- scripts used to allow captcha verification to function -->
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

  </div>
  </script>
  <!-- footer for the page -->
  <?php include 'footer.php'; ?>
</body>

</html>