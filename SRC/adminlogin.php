<?php
include 'connecdb.php';
session_start();
if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    if(mysqli_num_rows($select_admin) > 0){
        $row = mysqli_fetch_assoc($select_admin);
        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_password'] = $row['password'];
        $_SESSION['admin_id'] = $row['id'];
        echo '<script>alert("Login Successful")</script>';


        header('location:adminpanel.php');

    }else{
        echo '<script>alert("Incorrect username or password")</script>';

    }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/adminpanel.css">
</head>
<body>
    <div class="topheading">
        <centre><h1 id="top_heading">Admin Panel</h></centre>
    </div>
    <div class="form-box">

   <form action="" method="post">
      <h3>login Panel</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</div>

</body>
</html>